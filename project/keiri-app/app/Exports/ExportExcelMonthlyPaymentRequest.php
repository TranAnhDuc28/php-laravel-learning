<?php

namespace App\Exports;

use App\Exports\Sheets\SheetBilling;
use App\Exports\Sheets\SheetReportDailyMonth;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ExportExcelMonthlyPaymentRequest implements WithMultipleSheets
{

    private $data;

    public function __construct($data)
    {
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
            $titleSheetReportDaily = Carbon::now()->month($key)->format('M_Y');
            $sheets[] = new SheetReportDailyMonth($titleSheetReportDaily, $value);
            $titleReportDailySheets[] = $titleSheetReportDaily;
        }

        $sheets[] = new SheetBilling($titleReportDailySheets);

        return $sheets;
    }
}
