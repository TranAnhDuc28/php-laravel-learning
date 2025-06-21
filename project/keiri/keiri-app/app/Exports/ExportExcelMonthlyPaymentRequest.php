<?php

namespace App\Exports;

use App\Exports\Sheets\SheetBilling;
use App\Exports\Sheets\SheetReportDailyMonth;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ExportExcelMonthlyPaymentRequest implements WithMultipleSheets
{

    private $monthReports;
    private $data;

    public function __construct($monthReports, $data)
    {
        $this->monthReports = $monthReports;
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];
        $titleReportDailySheets = [];

        foreach ($this->data as $key => $value) {
//            dd($value);
            $titleSheetReportDaily = Carbon::parse($key)->format('M_Y');
            $sheets[] = new SheetReportDailyMonth($key, $value);
            $titleReportDailySheets[] = $titleSheetReportDaily;
        }

        $sheets[] = new SheetBilling($titleReportDailySheets);

        return $sheets;
    }
}
