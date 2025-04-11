<?php

namespace App\Http\Controllers;

use App\Models\ApplicationForm;
use App\Models\LeaveDays;
use App\Models\LeaveDaysLog;
use App\Models\TeamUser;
use App\Models\CheckInOut;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Services\CommonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Rules\NoTimeOverlap;

class ApplicationFormController extends Controller
{
    private CommonService $commonService;

    public function __construct(CommonService $commonService)
    {
        $this->commonService = $commonService;
    }

    public function list(Request $request)
    {
        // Lấy user_id của người đang đăng nhập
        $leaderId = $request->user()->id;

        // Lấy team_name mà user đang đăng nhập là leader
        $leaderTeam = TeamUser::where('user_id', $leaderId)
            ->where('role', 1) // 1 là role leader
            ->first();

        if (!$leaderTeam && !$request->user()->isPu() && !$request->user()->isAd() && !$request->user()->isMod()) {
            abort(403,"You are not the leader of any team!");
        }

        // Lấy danh sách user_id của các member trong team
        if ($request->user()->isAd()){
            $members = TeamUser::where('role', 1)
                ->with('user')
                ->get();
            $memberIds = $members->pluck('user_id');
        } elseif ($request->user()->isPu()) {
            $members = User::whereIn('role', [1, 2])
                ->get();
            $memberIds = $members->pluck('id');
        } elseif ($request->user()->isMod()) {
            $members = User::whereIn('role', [1, 2])
                ->get();
            $memberIds = $members->pluck('id');
        }else {
            $members = TeamUser::where('team_id', $leaderTeam->team_id)
                ->where('role', 2)
                ->with('user')
                ->get();
            $memberIds = $members->pluck('user_id');
        }

        // Chuẩn bị tháng hiện tại và tháng trước
        $currentMonth = now();
        $lastMonth = now()->startOfMonth()->subMonth();

        // Mặc định là tháng trước nếu không có tham số month
//        $selectedMonth = $request->month ?? $lastMonth->format('Y-m');
        $selectedMonth = $request->month ?? $currentMonth->format('Y-m');

        // Lấy danh sách đơn xin nghỉ phép của các member
        $query = ApplicationForm::whereIn('user_id', $memberIds);

        // Filter theo user_id nếu có
        if ($request->has('user_id') && $request->user_id != 'all') {
            $query->where('user_id', $request->user_id);
        }

        // Filter theo tháng
        if ($selectedMonth) {
            $query->whereYear('start_date', substr($selectedMonth, 0, 4))
                ->whereMonth('start_date', substr($selectedMonth, 5, 2));
        }

        $applications = $query->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('application_forms.list', [
            'applications' => $applications,
            'members' => $members,
            'selectedUserId' => $request->user_id ?? 'all',
            'selectedMonth' => $selectedMonth,
            'months' => [
                $currentMonth->format('Y-m') => $currentMonth->format('F Y'),
                $lastMonth->format('Y-m') => $lastMonth->format('F Y'),
            ]
        ]);

    }

//    public function approval(Request $request)
//    {
//        $applicationIds = $request->application_ids;
//
//        DB::beginTransaction();
//        try {
//            ApplicationForm::whereIn('id', $applicationIds)
//                ->update([
//                    'verify_status' => true,
//                    'approved_by' => auth()->id(),
//                    'updated_at' => now(),
//                    'updated_by' => auth()->id()
//                ]);
//
//            DB::commit();
//            return response()->json(['message' => 'Applications approved successfully']);
//        } catch (\Exception $e) {
//            DB::rollback();
//            return response()->json(['message' => 'Error approving applications'], 500);
//        }
//    }
    public function approval(Request $request)
    {
        if ($request->user()->isMod()) {
            abort(403,"You are not the leader of any team!");
        }

        $applicationIds = $request->application_ids;

        DB::beginTransaction();
        try {
            // Get all applications that need to be approved
            $applications = ApplicationForm::whereIn('id', $applicationIds)->get();

            // Update verify status for all applications
            ApplicationForm::whereIn('id', $applicationIds)
                ->update([
                    'verify_status' => true,
                    'approved_by' => auth()->id(),
                    'updated_at' => now(),
                    'updated_by' => auth()->id()
                ]);

            // Process each approved application
            foreach ($applications as $application) {
                if ($application->total_hours >= 8) {
                    $this->createCheckInOutRecords($application);
                } else {
                    $this->handlePartialDayLeave($application);
                }
                $this->calculateDaysOff($application);
            }

            DB::commit();
//            return response()->json(['message' => 'Applications approved successfully']);
            return redirect()->route('application-forms.list')
                ->with('success', 'Applications approved successfully');
        } catch (\Exception $e) {
            DB::rollback();
//            return response()->json(['message' => 'Error approving applications: ' . $e->getMessage()], 500);
            return redirect()->route('application-forms.list')
                ->with('error', 'Error approving applications');
        }
    }

    private function handlePartialDayLeave($application)
    {
        try {
            $paidLeaveTypes = [1, 3, 4, 5, 6, 7];
            $unpaidLeaveTypes = [2, 9];

            $paidLeaveHours = in_array($application->leave_type, $paidLeaveTypes) ? $application->total_hours : 0;
            $unpaidLeaveHours = in_array($application->leave_type, $unpaidLeaveTypes) ? $application->total_hours : 0;
            $workingTime = 8 - $application->total_hours;

            // Check if record exists
            $existingRecord = CheckInOut::where('user_id', $application->user_id)
                ->where('date', $application->start_date)
                ->first();

            if ($existingRecord) {
                $paidLeaveHours = $existingRecord->paid_leave + $paidLeaveHours;
                $unpaidLeaveHours = $existingRecord->unpaid_leave + $unpaidLeaveHours;
                // Update existing record
                $existingRecord->update([
                    'paid_leave' => $paidLeaveHours,
                    'unpaid_leave' => $unpaidLeaveHours,
                ]);
            } else {
                CheckInOut::create([
                    'user_id' => $application->user_id,
                    'date' => $application->start_date,
                    'check_in' => '00:00',
                    'check_out' => null,
                    'working_time' => 0,
                    'paid_leave' => $paidLeaveHours,
                    'unpaid_leave' => $unpaidLeaveHours,
//                    'status' => false
                ]);
            }
        } catch (\Exception $e) {
            throw $e; // Re-throw để transaction có thể rollback
        }
    }

    private function calculateDaysOff($application)
    {
        $leaveDays = LeaveDays::where('user_id', $application->user_id)
            ->where('year', now()->year)
            ->first();
        $leaveDaysAvai = $leaveDays->days_off + $leaveDays->carried_days_off + $leaveDays->award_days_off;
        $dayToOff = $application->total_hours/8;
        if (now()->month < 6) {
            $leaveDaysAvai = $leaveDays->days_off + $leaveDays->carried_days_off + $leaveDays->award_days_off + $leaveDays->days_off_to_june;
        }

        if ($application->leave_type == 4) {
//                if ($leaveDays->compensatory_day_off < 1 && $leaveDays->compensatory_day_off < $dayToOff ) {
//                    return back()
//                        ->withErrors(['message' => "You don't have enough compensatory days to use"])
//                        ->withInput();
//                }
            $leaveDays->update([
                'compensatory_day_off' => $leaveDays->compensatory_day_off - $dayToOff,
                'days_off_to_used' => $leaveDays->days_off_to_used + $dayToOff,
            ]);
        } elseif ($application->leave_type == 3) {
//                if ($leaveDaysAvai > 0 && $leaveDays->days_off_in_advance < $dayToOff) {
//                    return back()
//                        ->withErrors(['message' => "You don't have enough paid leave in advance to use"])
//                        ->withInput();
//                }
            $leaveDays->update([
                'days_off_in_advance' => $leaveDays->days_off_in_advance - $dayToOff,
                'days_off_in_advance_to_used' => $leaveDays->days_off_in_advance_to_used + $dayToOff,
            ]);
        } elseif (in_array($application->leave_type, [1, 6])) {
//                if ($leaveDaysAvai < $dayToOff) {
//                    return back()
//                        ->withErrors(['message' => "You don't have enough paid leave to use"])
//                        ->withInput();
//                } else
            if ($leaveDaysAvai == $dayToOff) {
                $leaveDays->update([
                    'days_off_to_june' => 0,
                    'days_off' => 0,
                    'award_days_off' => 0,
                    'carried_days_off' => 0,
                    'days_off_to_used' => $leaveDays->days_off_to_used + $dayToOff,
                ]);
            } elseif ($leaveDaysAvai > $dayToOff) {
                $daysNeeded = $dayToOff;
                $remainingDays = $daysNeeded;

                // Các giá trị ban đầu
                $newDaysOffToJune = $leaveDays->days_off_to_june;
                $newCarriedDaysOff = $leaveDays->carried_days_off;
                $newDaysOff = $leaveDays->days_off;
                $newAwardDaysOff = $leaveDays->award_days_off;

                if (now()->month < 6) {
                    // Trừ từ days_off_to_june trước
                    if ($newDaysOffToJune > 0) {
                        if ($newDaysOffToJune >= $remainingDays) {
                            $newDaysOffToJune -= $remainingDays;
                            $remainingDays = 0;
                        } else {
                            $remainingDays -= $newDaysOffToJune;
                            $newDaysOffToJune = 0;
                        }
                    }
                }

                // Tiếp theo trừ từ days_off
                if ($remainingDays > 0 && $newDaysOff > 0) {
                    if ($newDaysOff >= $remainingDays) {
                        $newDaysOff -= $remainingDays;
                        $remainingDays = 0;
                    } else {
                        $remainingDays -= $newDaysOff;
                        $newDaysOff = 0;
                    }
                }

                // Tiếp theo trừ từ carried_days_off
                if ($remainingDays > 0 && $newCarriedDaysOff > 0) {
                    if ($newCarriedDaysOff >= $remainingDays) {
                        $newCarriedDaysOff -= $remainingDays;
                        $remainingDays = 0;
                    } else {
                        $remainingDays -= $newCarriedDaysOff;
                        $newCarriedDaysOff = 0;
                    }
                }

                // Cuối cùng trừ từ award_days_off
                if ($remainingDays > 0 && $newAwardDaysOff > 0) {
                    if ($newAwardDaysOff >= $remainingDays) {
                        $newAwardDaysOff -= $remainingDays;
                        $remainingDays = 0;
                    } else {
                        $remainingDays -= $newAwardDaysOff;
                        $newAwardDaysOff = 0;
                    }
                }

                if (now()->month < 6) {
                    $leaveDays->update([
                        'days_off_to_june' => $newDaysOffToJune,
                        'days_off' => $newDaysOff,
                        'award_days_off' => $newAwardDaysOff,
                        'carried_days_off' => $newCarriedDaysOff,
                        'days_off_to_used' => $leaveDays->days_off_to_used + $dayToOff,
                    ]);
                } else {
                    $leaveDays->update([
                        'days_off' => $newDaysOff,
                        'award_days_off' => $newAwardDaysOff,
                        'carried_days_off' => $newCarriedDaysOff,
                        'days_off_to_used' => $leaveDays->days_off_to_used + $dayToOff,
                    ]);
                }
            }
        }
    }
    private function createCheckInOutRecords($application)
    {
        try {
            // Get date range between start_date and end_date
            $startDate = Carbon::parse($application->start_date);
            $endDate = Carbon::parse($application->end_date);
            $dates = [];

            // If start_date equals end_date, only process one day
            if ($startDate->equalTo($endDate)) {
                if (!$startDate->isWeekend()) {
                    $dates[] = $startDate->format('Y-m-d');
                }
            } else {
                // Create array of dates excluding weekends
                for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
                    if (!$date->isWeekend()) {
                        $dates[] = $date->format('Y-m-d');
                    }
                }
            }

            if (empty($dates)) {
                return; // No valid dates to process
            }

            // Define leave types for paid and unpaid leave
            $paidLeaveTypes = [1, 3, 4, 5, 6, 7];
            $unpaidLeaveTypes = [2, 9];

            // Determine leave hours based on leave type
            $paidLeaveHours = in_array($application->leave_type, $paidLeaveTypes) ? 8 : 0;
            $unpaidLeaveHours = in_array($application->leave_type, $unpaidLeaveTypes) ? 8 : 0;

            foreach ($dates as $date) {
                if(CheckInOut::recordExists($application->user_id, $date)) {
                    CheckInOut::safeDelete($application->user_id, $date);
                }

                CheckInOut::create([
                    'user_id' => $application->user_id,
                    'date' => $date,
                    'check_in' => '00:00:00',
                    'check_out' => '00:00:00',
                    'working_time' => 0,
                    'paid_leave' => $paidLeaveHours,
                    'unpaid_leave' => $unpaidLeaveHours,
//                    'status' => true
                ]);

            }

        } catch (\Exception $e) {
            throw $e; // Re-throw để transaction có thể rollback
        }
    }

    public function index()
    {
        $forms = ApplicationForm::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('application_forms.index', compact('forms'));
    }

    public function create()
    {
        
        $lastMonth = now()->startOfMonth()->subMonth();
        $exceedDay = $this->commonService->startDayApplicationForm(Auth::id());

        if ($lastMonth->month == 12) {
            $leaveDayLog = LeaveDays::where('user_id', Auth::id())
                ->where('year', now()->year)
                ->first();
        } else {
            $leaveDayLog = LeaveDaysLog::where('user_id', Auth::id())
                ->whereMonth('date', $lastMonth->month)
                ->whereYear('date', $lastMonth->year)
                ->first();
        }

        return view('application_forms.create', [
            'exceedDay' => $exceedDay,
            'leaveDayLog' => $leaveDayLog,
            'isNewYear' => $lastMonth->month == 12,
        ]);
    }

    public function store(Request $request)
    {

        $exceedDay = $this->commonService->startDayApplicationForm(Auth::id());
        $validated = $request->validate([
            'leave_type' => 'required|integer',
            'start_date' => [
                'required',
                'date',
                'after_or_equal:'.$exceedDay,
            ],
            'end_date' => [
                'required',
                'date',
//                'after_or_equal:'.$exceedDay,
                'after_or_equal:start_date',
                new NoTimeOverlap,
            ],
            'start_time_hour' => 'required|in:08,09,10,11,12,13,14,15,16,17',
            'start_time_minute' => 'required|in:00,15,30,45',
            'end_time_hour' => 'required|in:08,09,10,11,12,13,14,15,16,17',
            'end_time_minute' => 'required|in:00,15,30,45',
            'leave_reason' => 'required|string|max:255',
        ]);

        $start = Carbon::parse($validated['start_date']);
        $end = Carbon::parse($validated['end_date']);

        if ($start->format('Y-m') !== $end->format('Y-m')) {
            return back()
                ->withErrors(['message' => 'Start date and end date must be in the same month.']);
        }

        // Combine hours and minutes into time format
        $start_time = $validated['start_time_hour'] . ':' . $validated['start_time_minute'];
        $end_time = $validated['end_time_hour'] . ':' . $validated['end_time_minute'];

        // Validate that end time is after start time
        if ($validated['start_date'] === $validated['end_date'] && $end_time <= $start_time) {
            return back()
                ->withErrors(['end_time' => 'End time must be after start time.'])
                ->withInput();
        }
        $total_hours = $this->commonService->calculateTotalTime($validated['start_date'], $validated['end_date'], $start_time, $end_time, $validated['leave_type']);

        if ($total_hours['message'] != "") {
            return back()
                ->withErrors(['start_time' => $total_hours['message']])
                ->withInput();
        }

        if (!in_array($validated['leave_type'], [2, 5, 7])) {
            // phép khả dụng
            $leaveDays = LeaveDays::where('user_id', Auth::id())
                ->where('year', now()->year)
                ->first();

            if(!isset($leaveDays)) {
                return back()
                    ->withErrors(['message' => "You don't have any paid leave day to use"])
                    ->withInput();
            }

            $leaveDaysAvai = $leaveDays->days_off + $leaveDays->carried_days_off + $leaveDays->award_days_off;

            if (now()->month < 6) {
                $leaveDaysAvai = $leaveDays->days_off + $leaveDays->carried_days_off + $leaveDays->award_days_off + $leaveDays->days_off_to_june;
            }

            //TODO: lấy toàn bộ bản ghi có leavetype = 1 3 4 6 để check total hour
            $hoursToOff = $total_hours['total_hours']/8;
            if ($validated['leave_type'] == 4) {
                $total_hours_type_4 = ApplicationForm::where('user_id', Auth::id())
                    ->where('leave_type', 4)
                    ->where('verify_status', false)
                    ->whereMonth('start_date', now()->month)
                    ->whereYear('start_date', now()->year)
                    ->sum('total_hours');
                if ($leaveDays->compensatory_day_off < 1 || ($leaveDays->compensatory_day_off - ($total_hours_type_4/8)) < $hoursToOff ) {
                    return back()
                        ->withErrors(['message' => "You don't have enough compensatory days to use"])
                        ->withInput();
                }
            } elseif ($validated['leave_type'] == 3) {
                $total_hours_type_3 = ApplicationForm::where('user_id', Auth::id())
                    ->where('leave_type', 3)
                    ->where('verify_status', false)
                    ->whereMonth('start_date', now()->month)
                    ->whereYear('start_date', now()->year)
                    ->sum('total_hours');
                if ($leaveDays->days_off_in_advance < 0 || ($leaveDays->days_off_in_advance - ($total_hours_type_3/8)) < $hoursToOff) {
                    return back()
                        ->withErrors(['message' => "You don't have enough paid leave in advance to use"])
                        ->withInput();
                }
            } elseif (in_array($validated['leave_type'], [1, 6])) {
                $total_hours_type_1_6 = ApplicationForm::where('user_id', Auth::id())
                    ->whereIn('leave_type', [1, 6])
                    ->where('verify_status', false)
                    ->whereMonth('start_date', now()->month)
                    ->whereYear('start_date', now()->year)
                    ->sum('total_hours');
                if ($leaveDaysAvai < 0 || ($leaveDaysAvai - ($total_hours_type_1_6/8)) < $hoursToOff) {
                    return back()
                        ->withErrors(['message' => "You don't have enough paid leave to use"])
                        ->withInput();
                }
            }
        }
        $form = new ApplicationForm([
            'leave_type' => $validated['leave_type'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'start_time' => $start_time,
            'end_time' => $end_time,
            'total_hours' => $total_hours['total_hours'],
            'leave_reason' => $validated['leave_reason'],
        ]);

//        $form = new ApplicationForm($validated);
        $form->user_id = Auth::id();
        $form->created_by = Auth::id();
        $form->updated_by = Auth::id();
        $form->save();

        return redirect()->route('application-forms.index')
            ->with('success', 'Application form created successfully.');
    }

    public function edit(ApplicationForm $applicationForm)
    {
        if ($applicationForm->user_id !== Auth::id()) {
            abort(403);
        }

        if ($applicationForm->verify_status) {
            // Flash message thông báo (optional)
            return redirect()->route('application-forms.index')
                ->with('error', 'Cannot edit verified application form');
        }

        return view('application_forms.edit', compact('applicationForm'));
    }

    public function update(Request $request, ApplicationForm $applicationForm)
    {
        if ($applicationForm->user_id !== Auth::id()) {
            abort(403);
        }

//        $validated = $request->validate([
//            'leave_type' => 'required|integer',
//            'start_date' => 'required|date',
//            'end_date' => 'required|date|after_or_equal:start_date',
//            'start_time' => 'required',
//            'end_time' => 'required',
//            'leave_reason' => 'required|string|max:255',
//        ]);
//        $yesterday = now()->subDay()->format('Y-m-d');

        $validated = $request->validate([
            'leave_type' => 'required|integer',
//            'start_date' => 'required|date|after_or_equal:'.$yesterday,
            'end_date' => [
                'required',
                'date',
//                'after_or_equal:'.$yesterday,
                'after_or_equal:start_date'
            ],
            'start_time_hour' => 'required|in:08,09,10,11,12,13,14,15,16,17',
            'start_time_minute' => 'required|in:00,15,30,45',
//            'start_time_minute' => 'required|in:00',
            'end_time_hour' => 'required|in:08,09,10,11,12,13,14,15,16,17',
            'end_time_minute' => 'required|in:00,15,30,45',
            'leave_reason' => 'required|string|max:255',
        ]);

        // Combine hours and minutes into time format
        $start_time = $validated['start_time_hour'] . ':' . $validated['start_time_minute'];
        $end_time = $validated['end_time_hour'] . ':' . $validated['end_time_minute'];

        // Validate that end time is after start time
        if ($applicationForm->start_date === $validated['end_date'] && $end_time <= $start_time) {
            return back()
                ->withErrors(['end_time' => 'End time must be after start time'])
                ->withInput();
        }
        $total_hours = $this->commonService->calculateTotalTime($applicationForm->start_date, $validated['end_date'], $start_time, $end_time, $validated['leave_type']);
//        dd($total_hours_check);
        if ($total_hours['message'] != "") {
            return back()
                ->withErrors(['start_time' => $total_hours['message']])
                ->withInput();
        }
//        dd($total_hours);
//        $form = new ApplicationForm([
//            'leave_type' => $validated['leave_type'],
//            'start_date' => $validated['start_date'],
//            'end_date' => $validated['end_date'],
//            'start_time' => $start_time,
//            'end_time' => $end_time,
//            'total_hours' => $total_hours,
//            'leave_reason' => $validated['leave_reason'],
//        ]);
        $applicationForm->leave_type = $validated['leave_type'];
//        $applicationForm->start_date = $validated['start_date'];
        $applicationForm->end_date = $validated['end_date'];
        $applicationForm->start_time = $start_time;
        $applicationForm->end_time = $end_time;
        $applicationForm->total_hours = $total_hours['total_hours'];
        $applicationForm->leave_reason = $validated['leave_reason'];
//        $form = new ApplicationForm($validated);
//        $form->user_id = Auth::id();
//        $form->created_by = Auth::id();
//        $form->updated_by = Auth::id();
//        $form->save();

//        $applicationForm->update($validated);
        $applicationForm->updated_by = Auth::id();
        $applicationForm->save();

        return redirect()->route('application-forms.index')
            ->with('success', 'Application form updated successfully.');
    }

    public function destroy(ApplicationForm $applicationForm)
    {
        if ($applicationForm->user_id !== Auth::id()) {
            abort(403);
        }

        if ($applicationForm->verify_status) {
            return redirect()->route('application-forms.index')
                ->with('error', 'You cannot delete this application form');
        }

        $applicationForm->delete();

        return redirect()->route('application-forms.index')
            ->with('success', 'Application form deleted successfully.');
    }
}
