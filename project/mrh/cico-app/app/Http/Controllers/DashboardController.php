<?php

namespace App\Http\Controllers;

use App\Constants\CommonConstants;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CheckInOut;
use App\Services\CommonService;
//use Carbon\Carbon;

class DashboardController extends Controller
{
    private CommonService $commonService;

    public function __construct(CommonService $commonService)
    {
        $this->commonService = $commonService;
    }

    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $today = date('Y-m-d');
        $buttonDisplay = $this->commonService->getButtonDisplay($userId);
        $checkInOut = CheckInOut::with('user')
            ->where('user_id', $userId)
//            ->whereDate('date', Carbon::today())
            ->whereDate('date', $today)
            ->latest()
            ->first();
//        dd($buttonDisplay);
//        $today = date('Y-m-d');
//        $checkInStatus = CheckInOut::where('user_id', $request->user()->id)
//            ->whereDate('date', $today)
//            ->whereNull('check_out')
//            ->first();

//        $buttonDisplay = $checkInStatus ? 'checkOut' : 'checkIn';
        if (isset($checkInOut->check_in) && \Carbon\Carbon::parse($checkInOut->check_in)->format('H:i') == "00:00") {
            $checkInOut = null;
            $buttonDisplay = CommonConstants::CHECK_IN;
        }

        $totalUsers = User::count();
        return view('dashboard', [
            'totalUsers' => $totalUsers,
            'userRole' => $request->user()->role,
            'checkInOut' => $checkInOut,
            'checkInTime' => $checkInOut ? $checkInOut->check_in : null,
            'checkOutTime' => $checkInOut ? $checkInOut->check_out : null,
            'buttonDisplay' => $buttonDisplay
        ]);
    }
}
