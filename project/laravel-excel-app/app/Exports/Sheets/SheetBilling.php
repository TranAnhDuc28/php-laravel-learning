<?php

namespace App\Exports\Sheets;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SheetBilling implements FromView, WithEvents, WithTitle, withStyles
{
    private $titleSheets;

    public function __construct($titleSheets)
    {
        $this->titleSheets = $titleSheets;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return '3.請求書';
    }

    /**
     * @param Worksheet $sheet
     * @return void
     */
    public function styles(Worksheet $sheet): void
    {
        $sheet->getStyle($sheet->calculateWorksheetDimension())
            ->getFont()
            ->setName('Arial')
            ->setSize(11);
    }

    /**
     * @return View
     */
    public function view(): View
    {
        return view('export.billing');
    }

    /**
     * @return mixed
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                for ($i = 0; $i < ; $i++) {
//                    $sheet->setCellValue('H' . ($rowEndPrintData + 1), "=SUM(H{$rowStartPrintData}:J{$rowEndPrintData})");

                }
            }
        ];
    }
}
