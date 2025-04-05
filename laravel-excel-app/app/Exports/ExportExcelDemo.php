<?php

namespace App\Exports;

use App\Exports\Sheets\SheetDemo;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Events\AfterSheet;

class ExportExcelDemo implements WithMultipleSheets, WithEvents
{
    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];
        $year = Carbon::now()->year;

        for ($month = 1; $month <= 12; $month++) {
            $sheets[] = new SheetDemo($year, Carbon::now()->month($month)->format('M'));
        }

        return $sheets;
    }

    /**
     * Set default highlight (A1)
     *
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->setSelectedCells(null);
            }
        ];
    }
}
