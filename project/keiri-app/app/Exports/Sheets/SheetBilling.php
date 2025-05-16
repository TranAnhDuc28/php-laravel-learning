<?php

namespace App\Exports\Sheets;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SheetBilling implements FromView, WithEvents, WithTitle, withStyles
{
    private $titleReportDailySheets;

    public function __construct($titleReportDailySheets)
    {
        $this->titleReportDailySheets = $titleReportDailySheets;
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
     * @throws Exception
     */
    public function styles(Worksheet $sheet): void
    {
        $sheet->getStyle($sheet->calculateWorksheetDimension())
            ->getFont()
            ->setName('Arial')
            ->setSize(11);

        // Set width table column.
        $sheet->getColumnDimension('A')->setWidth(4.86);
        $sheet->getColumnDimension('E')->setWidth(19);
        $sheet->getColumnDimension('G')->setWidth(3);
        $sheet->getColumnDimension('H')->setWidth(5);
        $sheet->getColumnDimension('J')->setWidth(12.86);


        // Name company.
        $sheet->getStyle('A1:E1')->getFont()->setBold(true);

        // Address company.
        $sheet->getRowDimension(2)->setRowHeight(30);
        $sheet->getStyle('A2:E2')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_LEFT)
            ->setVertical(Alignment::VERTICAL_TOP)
            ->setWrapText(true);

        // "Invoice No".
        $sheet->getStyle('I2')->getFont()->setBold(true)->setItalic(true);
        $sheet->getStyle('I2')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_RIGHT)
            ->setVertical(Alignment::VERTICAL_CENTER);

        // "Date".
        $sheet->getStyle('I3')->getFont()->setBold(true)->setItalic(true);
        $sheet->getStyle('I3')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_RIGHT)
            ->setVertical(Alignment::VERTICAL_CENTER);

        // "INVOICE"
        $sheet->getRowDimension(4)->setRowHeight(20.25);
        $sheet->getRowDimension(5)->setRowHeight(23.25);
        $sheet->getStyle('A4:F4')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('J4')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('G4')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('G4')->getFont()
            ->setName('MS Reference Sans Serif')
            ->setSize(18)
            ->setBold(true)
            ->setItalic(true);

        //
        $sheet->getStyle('A7:J13')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('F7:F13')->getBorders()->getLeft()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('A7')->getFont()->setBold(true);
        $sheet->getStyle('F7')->getFont()->setBold(true);
        $sheet->getRowDimension(8)->setRowHeight(30);
        $sheet->getRowDimension(9)->setRowHeight(33.75);
        $sheet->getRowDimension(10)->setRowHeight(48.75);
        $sheet->getStyle('A8:J11')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_LEFT)
            ->setVertical(Alignment::VERTICAL_TOP)
            ->setWrapText(true);

        //
        $sheet->getStyle('A15:J21')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('F15:F21')->getBorders()->getLeft()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('A15')->getFont()->setBold(true);
        $sheet->getRowDimension(17)->setRowHeight(27);

        //
        $rowStartResult = 24;
        $countTableReportDailyMonth = $rowStartResult + count($this->titleReportDailySheets);
        $sheet->getStyle('A23:J29')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('A29:J23')->getFont()->setBold(true);
        $sheet->getStyle('A29:J23')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER)
            ->setWrapText(true);
        for ($row = $rowStartResult; $row <= $countTableReportDailyMonth; $row++) {
            $sheet->getRowDimension($row)->setRowHeight(21.75);
        }
        $sheet->getStyle('A29')->getFont()->setBold(true);

        // Sign.
        $sheet->getRowDimension(34)->setRowHeight(27);
        $sheet->getStyle('G34:J34')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);
    }

    /**
     * @return View
     */
    public function view(): View
    {
        $dataView = [
            'titleReportDailySheets' => $this->titleReportDailySheets,
        ];
        return view('export.billing', $dataView);
    }

    /**
     * @return mixed
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $countSheet = count($this->titleReportDailySheets);

                $sheet->setCellValue('J3', Carbon::now()->format('d-M-y'));
                $sheet->getStyle('J3')
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_RIGHT)
                    ->setVertical(Alignment::VERTICAL_CENTER);

                $rowAmountDataStart = 24;
                $rowAmountDataEnd = $rowAmountDataStart - 1 + $countSheet;
                for ($i = 0; $i < $countSheet; $i++) {
                    $sheet->setCellValue('F' . ($rowAmountDataStart + $i), "=LOOKUP(9^9, +'{$this->titleReportDailySheets[$i]}'!H:H)");
                }
                $sheet->getStyle([6, $rowAmountDataStart, 10, $rowAmountDataEnd])->getNumberFormat()->setFormatCode('"¥"#,##0;"¥"-#,##0');
            }
        ];
    }
}
