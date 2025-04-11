<?php

namespace App\Http\Controllers;

use App\Models\LeaveDays;
use App\Models\LeaveDaysLog;
use App\Models\User;
use App\Services\CommonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use voku\helper\ASCII;
use App\Constants\CommonConstants;

class LeaveDayController extends Controller
{
    private CommonService $commonService;

    public function __construct(CommonService $commonService)
    {
        $this->commonService = $commonService;
    }

    public function list(Request $request)
    {
//        $query = LeaveDaysLog::with(['user' => function($query) {
//            $query->whereIn('role', [1, 2]);
//        }]);
//
//        $checkInOuts = $query->get();
//
//        return view('leave_day.list', compact('checkInOuts'));

        $selectedYear = $request->input('year', date('Y'));
        $selectedMonth = $request->input('month', date('m'));

        $query = LeaveDaysLog::with(['user' => function($query) {
            $query->whereIn('role', [1, 2]);
        }])
            ->whereYear('date', $selectedYear)
            ->whereMonth('date', $selectedMonth);

        $checkInOuts = $query->get();

        // Generate available years (current year and previous year)
        $availableYears = [
            date('Y') => date('Y'),
            date('Y')-1 => date('Y')-1
        ];

        // Generate months
        $availableMonths = [];
        for ($i = 1; $i <= 12; $i++) {
            $availableMonths[str_pad($i, 2, '0', STR_PAD_LEFT)] = date('F', mktime(0, 0, 0, $i, 1));
        }

        return view('leave_day.list', compact(
            'checkInOuts',
            'selectedYear',
            'selectedMonth',
            'availableYears',
            'availableMonths'
        ));
    }

    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $checkInOuts = CheckInOut::with('user')
            ->where('user_id', $userId)
            ->orderBy('date', 'desc')
            ->paginate(50);
        return view('check_in_out.index', compact('checkInOuts'));
    }

    public function store(Request $request)
    {
        $userId = $request->user()->id;
        $now = now();

        $checkInStatus = $this->commonService->getCheckInRecordExists($userId);

        if ($checkInStatus && \Carbon\Carbon::parse($checkInStatus->check_in)->format('H:i') != "00:00") {
            return response()->json([
                'status' => 'error',
                'message' => 'Check-in record founded, please check-out again',
                'buttonDisplay' => CommonConstants::CHECK_OUT
            ], 404);
        }
        if (isset($checkInOut->check_in) && \Carbon\Carbon::parse($checkInStatus->check_in)->format('H:i') == "00:00") {
//            TODO: check lack time and calculate in special case if need, maybe not
//            $lack_time = ($checkInStatus->paid_leave + $checkInStatus->unpaid_leave) * 60 ...
            $checkInStatus->update([
                'in_lack_time' => $this->commonService->calculateInLackTime($now->format('H:i:s')),
                'check_in' => $now->format('H:i'),
            ]);
        } else {
            $checkInOut = CheckInOut::create([
                'user_id' => $userId,
                'in_lack_time' => $this->commonService->calculateInLackTime($now->format('H:i:s')),
                'date' => $now->format('Y-m-d'),
                'check_in' => $now->format('H:i'),
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Checked in successfully',
            'buttonDisplay' => CommonConstants::CHECK_OUT
        ]);
    }

//    public function show(CheckInOut $checkInOut)
//    {
//        return view('check_in_out.show', compact('checkInOut'));
//    }
//
//    public function edit(CheckInOut $checkInOut)
//    {
//        return view('check_in_out.edit', compact('checkInOut'));
//    }

    public function update(Request $request, CheckInOut $checkInOut)
    {
        $userId = $request->user()->id;
        $now = now();

        $checkInOut = $this->commonService->getCheckInRecordExists($userId);
        if (!$checkInOut) {
            return response()->json([
                'status' => 'error',
                'message' => 'No check-in record found',
                'buttonDisplay' => CommonConstants::CHECK_IN
            ], 404);
        }
        $outLackTime = $this->commonService->calculateOutLackTime($now->format('H:i:s'));
//        $outLackTime = $this->commonService->calculateOutLackTime("08:30:00");

        $actual_working_hour = $this->commonService->calculateActualWorkingHour($checkInOut->check_in, $now->format('H:i'));
        //$overtime_work = $this->commonService->calculateOvertimeWork($checkInOut->check_in, $request->check_out);

        $checkInOut->update([
            'check_out' => $now->format('H:i'),
            'out_lack_time' => $outLackTime,
            'working_time' => $this->commonService->calculateWorkingTime($checkInOut->in_lack_time, $outLackTime),
            'over_time' => $actual_working_hour["overtime_hours"],
            'official_working_hours' => $actual_working_hour["official_working_hours"],
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Checked out successfully',
            'buttonDisplay' => CommonConstants::CHECK_OUT
        ]);
    }

//    public function destroy(CheckInOut $checkInOut)
//    {
//        $checkInOut->delete();
//
//        return redirect()
//            ->route('check_in_out.index')
//            ->with('success', 'Check-in/out record deleted successfully');
//    }
}
