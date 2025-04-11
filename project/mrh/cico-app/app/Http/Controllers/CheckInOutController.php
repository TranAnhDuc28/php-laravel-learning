<?php

namespace App\Http\Controllers;

use App\Models\CheckInOut;
use App\Models\User;
use App\Services\CommonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use voku\helper\ASCII;
use App\Constants\CommonConstants;

class CheckInOutController extends Controller
{
    private CommonService $commonService;

    public function __construct(CommonService $commonService)
    {
        $this->commonService = $commonService;
    }

    public function list(Request $request)
    {
        // Tạo array chứa tháng hiện tại và tháng trước
        $availableMonths = [
            now()->startOfMonth()->subMonth()->format('Y-m') => now()->startOfMonth()->subMonth()->format('F Y'),
            now()->format('Y-m') => now()->format('F Y')
        ];

        // Lấy tháng được chọn từ request, mặc định là tháng trước
//        $selectedMonth = $request->input('month', now()->subMonth()->format('Y-m'));
        $selectedMonth = $request->input('month', now()->format('Y-m'));

        // Tính toán ngày đầu và cuối của tháng được chọn
        $date = Carbon::createFromFormat('Y-m|', $selectedMonth, 'Asia/Ho_Chi_Minh');
        $startOfMonth = $date->copy()->startOfMonth();
        $endOfMonth = $date->copy()->endOfMonth();

        // Lấy danh sách users không có role = 0
        $users = User::whereIn('role', [1, 2])->get();

        // Lấy user_id từ request, mặc định là null (All)
        $selectedUserId = $request->input('user_id');

        $query = CheckInOut::with(['user' => function($query) {
//            $query->where('role', '!=', 0);
            $query->whereIn('role', [1, 2]);
        }])
            ->whereHas('user', function($query) {
//                $query->where('role', '!=', 0);
                $query->whereIn('role', [1, 2]);
            })
            ->whereBetween('check_in_out.date', [$startOfMonth, $endOfMonth])
            ->join('users', 'check_in_out.user_id', '=', 'users.id')
            ->select('check_in_out.*')
            ->orderBy('users.name', 'asc')
            ->orderBy('check_in_out.date', 'asc');

        // Thêm điều kiện lọc theo user nếu có chọn
        if ($selectedUserId) {
            $query->where('check_in_out.user_id', $selectedUserId);
        }

        $checkInOuts = $query->get();

        return view('check_in_out.list', compact('checkInOuts', 'users', 'selectedUserId', 'availableMonths', 'selectedMonth'));
    }

    public function index(Request $request)
    {
//        $userId = $request->user()->id;
//        $checkInOuts = CheckInOut::with('user')
//            ->where('user_id', $userId)
//            ->orderBy('date', 'desc')
//            ->paginate(50);
//        return view('check_in_out.index', compact('checkInOuts'));
        $userId = $request->user()->id;
        $month = $request->get('month', 'current');

        $query = CheckInOut::with('user')->where('user_id', $userId);

        // Lọc theo tháng
        if ($month === 'current') {
            $query->whereMonth('date', now()->month)
                ->whereYear('date', now()->year);
        } elseif ($month === 'previous') {
            $query->whereMonth('date', now()->startOfMonth()->subMonth()->month)
                ->whereYear('date', now()->startOfMonth()->subMonth()->year);
        }

        $checkInOuts = $query->orderBy('date', 'desc')->get();

        return view('check_in_out.index', compact('checkInOuts', 'month'));
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

        $checkInTime = $now->format('H:i');
//        $checkInTime = "08:25";
        if (isset($checkInStatus->check_in) && \Carbon\Carbon::parse($checkInStatus->check_in)->format('H:i') == "00:00") {
//            TODO: check lack time and calculate in special case if need, maybe not
//            $lack_time = ($checkInStatus->paid_leave + $checkInStatus->unpaid_leave) * 60 ...
            if ($checkInStatus->paid_leave > 6) {
                return response()->json([
                    'status' => 'warning',
                    'message' => 'Today you have been used your paid leave, you can not check-in/out today!!!',
                    'buttonDisplay' => CommonConstants::CHECK_IN
                ], 404);
            }
            $checkInStatus->update([
                'in_lack_time' => $this->commonService->calculateInLackTime($checkInTime),
                'check_in' => $checkInTime,
            ]);
        } else {
            $checkInOut = CheckInOut::create([
                'user_id' => $userId,
                'in_lack_time' => $this->commonService->calculateInLackTime($checkInTime),
                'date' => $now->format('Y-m-d'),
                'check_in' => $checkInTime,
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

//        if (isset($checkInOut->check_out)) {
//            $lastCheckOutTime = Carbon::parse($now)->format('H:i');
//
//            $diffInMinutes = $checkInOut->check_out->diffInMinutes($lastCheckOutTime);
//
//            if ($diffInMinutes < 10) {
//                return response()->json([
//                    'status' => 'message',
//                    'message' => 'You must wait at least 30 minutes between check-outs. ' . (10 - $diffInMinutes) . ' minute(s) left.',
//                    'buttonDisplay' => CommonConstants::CHECK_OUT
//                ], 400);
//            }
//        }

        $checkOutTime = $now->format('H:i');

        $outLackTime = $this->commonService->calculateOutLackTime($checkOutTime);

        $actual_working_hour = $this->commonService->calculateActualWorkingHour($checkInOut->check_in, $checkOutTime);
        $checkInOut->update([
            'check_out' => $checkOutTime,
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

    public function preview(Request $request)
    {
        $users = User::whereIn('role', [1, 2])->get();
        $checkInOut = null;
        $message = "";

        if ($request->has(['user_id', 'date'])) {
            $checkInOut = CheckInOut::where('user_id', $request->user_id)
                ->where('date', $request->date)
                ->first();

            if (!$checkInOut) {
                $message = [
                    'type' => 'warning',
                    'content' => 'Not found record for ' . $request->date
                ];
            }
        }

        return view('check_in_out.preview', compact('users', 'checkInOut', 'message'));
    }

    public function change(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'check_in' => 'required',
            'check_out' => 'nullable',
            'in_lack_time' => 'nullable|integer|min:0',
            'out_lack_time' => 'nullable|integer|min:0',
            'working_time' => 'nullable|numeric|min:0',
            'over_time' => 'nullable|numeric|min:0',
            'official_working_hours' => 'nullable|numeric|min:0',
            'paid_leave' => 'nullable|numeric|min:0',
            'unpaid_leave' => 'nullable|numeric|min:0',
        ]);

        $checkInOut = CheckInOut::updateOrCreate(
            [
                'user_id' => $request->user_id,
                'date' => $request->date
            ],
            [
                'check_in' => $request->check_in,
                'check_out' => $request->check_out,
                'in_lack_time' => $request->in_lack_time ?? 0,
                'out_lack_time' => $request->out_lack_time ?? 0,
                'working_time' => $request->working_time ?? 0,
                'over_time' => $request->over_time ?? 0,
                'official_working_hours' => $request->official_working_hours ?? 0,
                'paid_leave' => $request->paid_leave ?? 0,
                'unpaid_leave' => $request->unpaid_leave ?? 0,
                'status' => true
            ]
        );

        return redirect()->route('check_in_out.preview', [
            'user_id' => $request->user_id,
            'date' => $request->date])
            ->with('success', 'Update successfully.');
//        return redirect()->route('check_in_out.preview')
//            ->with('success', 'Update successfully.');
    }

//    public function change(Request $request)
//    {
//        $checkInOut = CheckInOut::where('user_id', $request->user_id)
//            ->where('date', $request->date)
//            ->first();
//
//        if (!$checkInOut) {
//            return response()->json([
//                'success' => false,
//                'message' => 'Record not found for this user and date.'
//            ], 404);
//        }
//
//        try {
//            if ($request->type == 1) {
//                $checkInOut->update([
//                    'check_in' => $request->check_in,
//                ]);
//            } else {
//                $checkInOut->update([
//                    'check_in' => $request->check_in,
//                    'check_out' => $request->check_out,
//                    "in_lack_time" => $request->in_lack_time,
//                    "out_lack_time" => $request->out_lack_time,
//                    "working_time" => $request->working_time,
//                    "official_working_hours" => $request->official_working_hours,
//                    "paid_leave" => $request->paid_leave,
//                    "unpaid_leave" => $request->unpaid_leave,
//                    "status" => $request->status,
//                ]);
//            }
//
//            return response()->json([
//                'success' => true,
//                'message' => 'Record updated successfully',
//                'data' => $checkInOut
//            ], 200);
//
//        } catch (\Exception $e) {
//            return response()->json([
//                'success' => false,
//                'message' => 'Update failed',
//                'error' => $e->getMessage()
//            ], 500);
//        }
//    }

    public function patch(Request $request)
    {

        if (!isset($request->type) && !isset($request->confirm) && $request->confirm != "F$3@@!dSTs") {
            return response()->json([
                'success' => false,
                'message' => 'You dont have permission to perform this action.',
            ], 404);
        }

        $checkInOut = CheckInOut::where('user_id', $request->user_id)
            ->where('date', $request->date)
            ->first();

        if (!$checkInOut) {
            return response()->json([
                'success' => false,
                'message' => 'Record not found for this user and date.'
            ], 404);
        }

        try {
            if ($request->type == 1) {
                $checkInOut->update([
                    'check_in' => $request->check_in,
                    "in_lack_time" => $request->in_lack_time,
                ]);
            } else {
                $checkInOut->update([
                    'check_in' => $request->check_in,
                    'check_out' => $request->check_out,
                    "in_lack_time" => $request->in_lack_time,
                    "over_time" => $request->over_time,
                    "out_lack_time" => $request->out_lack_time,
                    "working_time" => $request->working_time,
                    "official_working_hours" => $request->official_working_hours,
                    "paid_leave" => $request->paid_leave,
                    "unpaid_leave" => $request->unpaid_leave,
                    "status" => $request->status,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Record updated successfully',
                'data' => $checkInOut
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Update failed',
                'error' => $e->getMessage()
            ], 500);
        }
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
