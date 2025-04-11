<?php

namespace App\Http\Controllers;

use App\Constants\CommonConstants;
use App\Models\ApplicationForm;
use App\Models\CheckInOut;
use App\Models\OvertimeForm;
use App\Models\Projects;
use App\Models\ProjectUser;
use App\Models\TeamUser;
use App\Models\User;
use App\Services\CommonService;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OvertimeFormController extends Controller
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

        // Lấy project_name mà user đang đăng nhập là manager
        $leaderTeam = Projects::where('user_id', $leaderId)
            ->get();

        $projectIds = $leaderTeam->pluck('id');

        if (!$leaderTeam && !$request->user()->isPu() && !$request->user()->isAd()) {
            abort(403,"You are not the leader of any team!");
        }

        // Lấy danh sách user_id của các member trong team
        if ($request->user()->isAd()){
            $members = User::where('role', "1")
                ->get();
            $memberIds = $members->pluck('id');
        } elseif ($request->user()->isPu()) {
            $members = User::where('role', "1")
                ->get();
            $memberIds = $members->pluck('id');
        } else {
            $members = ProjectUser::whereIn('project_id', $projectIds)
                ->with('user')
                ->get();
            $memberIds = $members->pluck('user_id');
        }

//        dd($memberIds);
        // Chuẩn bị tháng hiện tại và tháng trước
        $currentMonth = now();
        $lastMonth = now()->startOfMonth()->subMonth();

        // Mặc định là tháng trước nếu không có tham số month
//        $selectedMonth = $request->month ?? $lastMonth->format('Y-m');
        $selectedMonth = $request->month ?? $currentMonth->format('Y-m');

        // Lấy danh sách đơn xin nghỉ phép của các member
        $query = OvertimeForm::whereIn('user_id', $memberIds);

        // Filter theo user_id nếu có
        if ($request->has('user_id') && $request->user_id != 'all') {
            $query->where('user_id', $request->user_id);
        }

        // Filter theo tháng
        if ($selectedMonth) {
            $query->whereYear('date', substr($selectedMonth, 0, 4))
                ->whereMonth('date', substr($selectedMonth, 5, 2));
        }

        $overtimes = $query->with('user')
            ->orderBy('created_at', 'desc')
            ->get();
        //dd($members);
        return view('overtime_forms.list', [
            'overtimes' => $overtimes,
            'members' => $members,
            'selectedUserId' => $request->user_id ?? 'all',
            'selectedMonth' => $selectedMonth,
            'months' => [
                $currentMonth->format('Y-m') => $currentMonth->format('F Y'),
                $lastMonth->format('Y-m') => $lastMonth->format('F Y'),
            ]
        ]);

    }

    public function approval(Request $request)
    {
        $applicationIds = $request->overtime_ids;

        DB::beginTransaction();
        try {
            // Get all applications that need to be approved
            $overtimeObj = OvertimeForm::whereIn('id', $applicationIds)->get();

            // Update verify status for all applications
            OvertimeForm::whereIn('id', $applicationIds)
                ->update([
                    'verify_status' => true,
                    'approved_by' => auth()->id(),
                    'updated_at' => now(),
                    'updated_by' => auth()->id()
                ]);

            // Update status in check_in_out for corresponding records
            foreach ($overtimeObj as $overtime) {
                CheckInOut::where('user_id', $overtime->user_id)
                    ->where('date', $overtime->date)
                    ->update(['status' => false,
                        'official_working_hours' => $overtime->official_working_hours,]);
            }
            DB::commit();
//            return response()->json(['message' => 'Applications approved successfully']);
            return redirect()->route('overtime-forms.list')
                ->with('success', 'Overtime Form approved successfully');
        } catch (\Exception $e) {
            DB::rollback();
//            return response()->json(['message' => 'Error approving applications: ' . $e->getMessage()], 500);
            return redirect()->route('overtime-forms.list')
                ->with('error', 'Error approving overtime form');
        }
    }

    public function index()
    {
        $forms = OvertimeForm::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
//        dd($forms);
        return view('overtime_forms.index',
                        compact('forms'));
    }

    public function create()
    {
        $checkInOuts = CheckInOut::where('user_id', Auth::id())
            ->where('unpaid_leave', 0)
            ->where('paid_leave', '<=', 4)
            ->whereNotNull('check_in')
            ->whereNotNull('check_out')
            ->where(function($query) {
                $query->whereRaw('official_working_hours + over_time + paid_leave > 8');
            })
            ->whereNotExists(function($query) {
                $query->select(DB::raw(1))
                    ->from('overtime_form')
                    ->whereRaw('overtime_form.date = check_in_out.date')
                    ->whereRaw('overtime_form.user_id = check_in_out.user_id');
            })
            ->get();

//        dd($checkInOuts);
        return view('overtime_forms.create',
            [
                'checkio_records' => $checkInOuts,
            ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date'
        ]);

        $userId = $request->user()->id;

        $checkInStatus = $this->commonService->getCheckInRecordExists($userId, $validated['date']);
        if (!$checkInStatus) {
            return response()->json([
                'status' => 'error',
                'message' => 'Check-in record founded, please check-out again',
            ], 404);
        }

        $official_working_hours = $checkInStatus->paid_leave + $checkInStatus->official_working_hours;
        $total_official_working_hours = min($official_working_hours, 8);
        $actual_official_working_hours = 8 - $checkInStatus->paid_leave;

        $abc = OvertimeForm::create([
            'user_id' => $userId,
            'date' => $checkInStatus->date->format('Y-m-d'),
            'start_time' => $checkInStatus->check_in->format('H:i'),
            'end_time' => $checkInStatus->check_out->format('H:i'),
            'paid_leave' => $checkInStatus->paid_leave,
            'official_working_hours' => $actual_official_working_hours,
            'over_time' => $official_working_hours < 8 ? $official_working_hours + $checkInStatus->over_time - 8: $checkInStatus->over_time,
            'total_time' => $total_official_working_hours + $checkInStatus->over_time,
            'created_by' => $userId,
        ]);
        return redirect()->route('overtime-forms.index')
            ->with('success', 'Overtime form created successfully.');
    }

    public function info(Request $request)
    {
        $date = Carbon::parse($request->input('date'));
        $userId = $request->user()->id;
        $overtime_info = $this->commonService->getCheckInRecordExists($userId, $date);
        if (!$overtime_info) {
            return response()->json([
                'status' => 'error',
                'message' => 'Check-in record founded, please check-out again',
            ], 404);
        }

        $official_working_hours = $overtime_info->paid_leave + $overtime_info->official_working_hours;
        $total_official_working_hours = min($official_working_hours, 8);
        $actual_official_working_hours = 8 - $overtime_info->paid_leave;

        return response()->json([
            'success' => true,
            'start_time' => $overtime_info->check_in->format('H:i'),
            'end_time' => $overtime_info->check_out->format('H:i'),
            'paid_leave' => $overtime_info->paid_leave,
            'actual_official_working_hours' => $actual_official_working_hours,
            'official_working_hours' => $total_official_working_hours,
            'over_time' => $official_working_hours < 8 ? $official_working_hours + $overtime_info->over_time - 8: $overtime_info->over_time,
            'total_time' => $total_official_working_hours + $overtime_info->over_time,
        ]);
    }

//    public function edit(OvertimeForm $overtimeForm)
//    {
//        if ($overtimeForm->user_id !== Auth::id()) {
//            abort(403);
//        }
//        return view('overtime_forms.edit', compact('overtimeForm'));
//    }
//
//    public function update(Request $request, OvertimeForm $overtimeForm)
//    {
//        if ($overtimeForm->user_id !== Auth::id()) {
//            abort(403);
//        }
//
//        $validated = $request->validate([
//            'date' => 'required|date',
//            'start_time_hour' => 'required|in:17,18,19,20,21,22,23',
//            'start_time_minute' => 'required|in:00,15,30,45',
//            'end_time_hour' => 'required|in:17,18,19,20,21,22,23',
//            'end_time_minute' => 'required|in:00,15,30,45',
//            'end_time' => 'after_or_equal:start_time',
//        ]);
//
//        $overtimeForm->update($validated);
//        $overtimeForm->updated_by = Auth::id();
//        $time_start = strtotime($overtimeForm->start_time);
//        $time_end = strtotime($overtimeForm->end_time);
//        $overtimeForm->total_time = $time_start->diffInMinutes($time_end);
//        $overtimeForm->save();
//
//        return redirect()->route('overtime-forms.index')
//            ->with('success', 'Overtime form updated successfully.');
//    }

    public function destroy(OvertimeForm $overtimeForm)
    {
        if ($overtimeForm->user_id !== Auth::id()) {
            abort(403);
        }


        $overtimeForm->delete();

        return redirect()->route('overtime-forms.index')
            ->with('success', 'Overtime form deleted successfully.');
    }
}
