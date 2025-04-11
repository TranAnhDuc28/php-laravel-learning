<?php

namespace App\Http\Controllers;

use App\Models\DaysOffBySchedule;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DaysOffController extends Controller
{
    public function list(Request $request)
    {
        // Lấy năm hiện tại
        $currentYear = date('Y');

        // Lấy danh sách các năm từ start_date sử dụng EXTRACT
        $startYears = DaysOffBySchedule::selectRaw('DISTINCT EXTRACT(YEAR FROM start_date) as year')
            ->orderBy('year')
            ->pluck('year')
            ->toArray();

        // Lấy danh sách các năm từ end_date sử dụng EXTRACT
        $endYears = DaysOffBySchedule::selectRaw('DISTINCT EXTRACT(YEAR FROM end_date) as year')
            ->orderBy('year')
            ->pluck('year')
            ->toArray();

        // Gộp hai mảng năm và loại bỏ trùng lặp
        $years = array_unique(array_merge($startYears, $endYears));

        // Thêm năm hiện tại nếu chưa có trong danh sách
        if (!in_array($currentYear, $years)) {
            $years[] = $currentYear;
        }
        sort($years);

        // Lấy năm được chọn từ filter, mặc định là năm hiện tại
        $selectedYear = $request->input('year', $currentYear);

        // Query data với filter
        $daysOff = DaysOffBySchedule::whereYear('start_date', $selectedYear)
            ->orWhereYear('end_date', $selectedYear)
            ->orderBy('start_date', 'desc')
            ->get();

        // Map leave_type sang text
        $leaveTypes = [
            1 => 'Paid Leave',
//            3 => 'Paid Leave in advance',
//            5 => 'Special Leave'
        ];

        return view('days_off.list', compact('daysOff', 'years', 'selectedYear', 'leaveTypes'));
    }

    public function create()
    {
        $leaveTypes = [
            3 => 'Paid Leave in advance',
            5 => 'Special Leave'
        ];

        return view('days_off.create', compact('leaveTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'leave_type' => 'required|in:3,5'
        ]);

        // Kiểm tra xem có bị trùng với bản ghi nào không
        $existingRecord = DaysOffBySchedule::where(function($query) use ($validated) {
            $query->whereBetween('start_date', [$validated['start_date'], $validated['end_date']])
                ->orWhereBetween('end_date', [$validated['start_date'], $validated['end_date']])
                ->orWhere(function($q) use ($validated) {
                    $q->where('start_date', '<=', $validated['start_date'])
                        ->where('end_date', '>=', $validated['end_date']);
                });
        })->first();

        if ($existingRecord) {
            return back()
                ->withInput()
                ->withErrors(['date_overlap' => 'The selected dates overlap with existing records.']);
        }

        DaysOffBySchedule::create($validated);

        return redirect()->route('days-off.create')
            ->with('success', 'Days off record created successfully.');
    }

    public function destroy($id)
    {
        try {
            $dayOff = DaysOffBySchedule::findOrFail($id);
            $dayOff->delete();

            return redirect()->route('days-off.list')
                ->with('success', 'Record deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('days-off.list')
                ->with('error', 'Failed to delete record');
        }
    }
}
