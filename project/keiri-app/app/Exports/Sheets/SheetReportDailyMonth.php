<?php

namespace App\Exports\Sheets;

use Carbon\Carbon;
use DateTime;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SheetReportDailyMonth implements WithTitle, withEvents, FromView, withStyles
{
    private $month;
    private $year;
    private $data;

    public function __construct(int $year, string $month, $data)
    {
        $this->month = $month;
        $this->year = $year;
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return '2.' . $this->month . '_' . $this->year;
    }

    public function view(): View
    {
        return view('export.monthly_payment_request', ['data' => $this->data]);
    }

    /**
     * @param Worksheet $sheet
     * @return void
     */
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle($sheet->calculateWorksheetDimension())
            ->getFont()
            ->setName('ＭＳ Ｐゴシック')
            ->setSize(10);
    }

    /**
     * @return mixed
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $month = Carbon::parse($this->month)->format('m');
                $day = Carbon::create($this->year, $month)->daysInMonth;
                $excelDate = Date::PHPToExcel(new DateTime("{$this->year}-$month-$day"));

                // Title report.
                $sheet->getStyle('A1')->getNumberFormat()->setFormatCode('"稼""働""報""告""書"([$-ja-JP]yyyy"年"m"月""分")');
                $sheet->setCellValue('A1', $excelDate);
                $sheet->getStyle('A1')->getFont()->setName('ＭＳ Ｐゴシック')->setSize(14);
                $sheet->getStyle('A1')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                    ->setVertical(Alignment::VERTICAL_BOTTOM);
                $sheet->getRowDimension(1)->setRowHeight(20);
                $sheet->mergeCells('A1:J1');

                // Name company.
                $sheet->setCellValue('A4', 'ビジネスシステムズ株式会社殿');
                $sheet->mergeCells('A4:C4');

                //
                $sheet->setCellValue('J4', Carbon::now()->format('Y年n月j日'));
                $sheet->getStyle('J4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
                $sheet->mergeCells('J4:H4');

                // Description.
                $sheet->setCellValue('B5', '下記のとおり実施しましたので報告致します。');

                // "記"
                $sheet->setCellValue('B7', '記');
                $sheet->mergeCells('B7:J7');
                $sheet->getStyle('B7:J7')
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                    ->setVertical(Alignment::VERTICAL_BOTTOM);

                // 1. 稼働期間
                $sheet->setCellValue('A9', '１');
                $sheet->setCellValue('B9', '稼働期間');
                $sheet->setCellValue('C9', '2024年10月1日～10月31日');

                // 2. 作業報告書及びご請求金額.
                $sheet->setCellValue('A12', '２');
                $sheet->setCellValue('B12', '作業報告書及びご請求金額');

                // (単位：円・時間).
                $sheet->setCellValue('J12', '(単位：円・時間)');
                $sheet->getStyle('J12')
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_RIGHT)
                    ->setVertical(Alignment::VERTICAL_BOTTOM);

                //
                $countData = count($this->data);
                $rowStartTable = 13;
                $rowStartPrintData = 14;
                $rowEndPrintData = $rowStartTable + ($countData * 2);

                // Set width table column.
                $sheet->getColumnDimension('A')->setWidth(3);
                $sheet->getColumnDimension('B')->setWidth(13.5);
                $sheet->getColumnDimension('C')->setWidth(6);
                $sheet->getColumnDimension('D')->setWidth(9);
                $sheet->getColumnDimension('E')->setWidth(13);
                $sheet->getColumnDimension('F')->setWidth(5);
                $sheet->getColumnDimension('G')->setWidth(21);

                // Border table.
                $sheet->getStyle([2, $rowStartTable, 10, $rowEndPrintData])
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN);
                $sheet->getStyle([2, $rowStartTable, 10, $rowEndPrintData])
                    ->getBorders()
                    ->getOutline()
                    ->setBorderStyle(Border::BORDER_MEDIUM);

                // Header table.
                $sheet->getRowDimension('13')->setRowHeight(42.5);
                $sheet->getStyle('B13:J13')
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                    ->setVertical(Alignment::VERTICAL_CENTER)
                    ->setWrapText(true);
                $sheet->getStyle('B13:J13')
                    ->getBorders()
                    ->getBottom()
                    ->setBorderStyle(Border::BORDER_MEDIUM);

                /* Format column table. */
                if ($countData) {
                    // Column "要員名".
                    $sheet->getStyle([2, $rowStartPrintData, 2, $rowEndPrintData])
                        ->getAlignment()
                        ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                        ->setVertical(Alignment::VERTICAL_CENTER)
                        ->setWrapText(true);

                    // Column "ランク".
                    $sheet->getStyle([3, $rowStartPrintData, 3, $rowEndPrintData])
                        ->getAlignment()
                        ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                        ->setVertical(Alignment::VERTICAL_CENTER);

                    // Column "区分".
                    $sheet->getStyle([4, $rowStartPrintData, 4, $rowEndPrintData])
                        ->getAlignment()
                        ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                        ->setVertical(Alignment::VERTICAL_CENTER);
                    $sheet->getStyle([4, $rowStartPrintData, 4, $rowEndPrintData])
                        ->getBorders()
                        ->getRight()
                        ->setBorderStyle(Border::BORDER_NONE);

                    // Column "契約単金(上段：月額、下段：時間単価）".
                    $sheet->getStyle([5, $rowStartPrintData, 5, $rowEndPrintData])
                        ->getAlignment()
                        ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                        ->setVertical(Alignment::VERTICAL_CENTER)
                        ->setWrapText(true);
                    $sheet->getStyle([5, $rowStartPrintData, 5, $rowEndPrintData])
                        ->getNumberFormat()
                        ->setFormatCode(NumberFormat::FORMAT_NUMBER)
                        ->setFormatCode('#,##0');

                    // Column "時間外稼働.".
                    $sheet->getStyle([6, $rowStartPrintData, 6, $rowEndPrintData])
                        ->getAlignment()
                        ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                        ->setVertical(Alignment::VERTICAL_CENTER)
                        ->setWrapText(true);

                    // Column "業務内容".
                    $sheet->getStyle([7, $rowStartPrintData, 7, $rowEndPrintData])
                        ->getAlignment()
                        ->setVertical(Alignment::VERTICAL_CENTER)
                        ->setWrapText(true);

                    // Column "計".
                    $sheet->getStyle([8, $rowStartPrintData, 8, $rowEndPrintData])
                        ->getAlignment()
                        ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                        ->setVertical(Alignment::VERTICAL_CENTER);
                    $sheet->getStyle([8, $rowStartPrintData, 8, $rowEndPrintData])
                        ->getNumberFormat()
                        ->setFormatCode(NumberFormat::FORMAT_NUMBER)
                        ->setFormatCode('#,##0');
                    for ($row = $rowStartPrintData; $row <= $rowEndPrintData; $row++) {
                        $sheet->setCellValue("H{$row}", "=E{$row}");
                        $row++;
                    }
                }

                // Result calculation.
                $sheet->getStyle([2, ($rowEndPrintData + 1), 7, ($rowEndPrintData + 3)])
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                    ->setVertical(Alignment::VERTICAL_CENTER);
                $sheet->getStyle([2, ($rowEndPrintData + 1), 7, ($rowEndPrintData + 3)])
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(Border::BORDER_MEDIUM);

                $sheet->getStyle([8, ($rowEndPrintData + 1), 10, ($rowEndPrintData + 3)])
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                    ->setVertical(Alignment::VERTICAL_CENTER);
                $sheet->getStyle([8, ($rowEndPrintData + 1), 10, ($rowEndPrintData + 3)])
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(Border::BORDER_MEDIUM);

                $this->setRowHeights($sheet, $rowEndPrintData + 1, $rowEndPrintData + 3, 19);

                if ($countData) {
                    $sheet->getStyle([8, ($rowEndPrintData + 1), 8, ($rowEndPrintData + 3)])
                        ->getNumberFormat()
                        ->setFormatCode(NumberFormat::FORMAT_NUMBER)
                        ->setFormatCode('#,##0');
                    $sheet->setCellValue('H' . ($rowEndPrintData + 1), "=SUM(H{$rowStartPrintData}:J{$rowEndPrintData})");
                    $sheet->setCellValue('H' . ($rowEndPrintData + 2), 0);
                    $sheet->setCellValue('H' . ($rowEndPrintData + 3), '=H' . ($rowEndPrintData + 1));
                }

                /* Sign. */
                $sheet->setCellValue('G' . ($rowEndPrintData + 5), Carbon::now()->format('d, F, Y'));
                $sheet->getStyle('G' . ($rowEndPrintData + 5))
                    ->getAlignment()
                    ->setVertical(Alignment::VERTICAL_BOTTOM);

                $sheet->getRowDimension($rowEndPrintData + 6)->setRowHeight(58);
                $sheet->mergeCells([7, ($rowEndPrintData + 6), 9, ($rowEndPrintData + 6)]);
                $sheet->mergeCells([7, ($rowEndPrintData + 7), 9, ($rowEndPrintData + 7)]);
                $sheet->mergeCells([7, ($rowEndPrintData + 8), 9, ($rowEndPrintData + 8)]);

                $sheet->getStyle([7, ($rowEndPrintData + 6), 9, ($rowEndPrintData + 6)])
                    ->getBorders()
                    ->getBottom()
                    ->setBorderStyle(Border::BORDER_THIN);

                $sheet->getStyle('G' . ($rowEndPrintData + 6) . ':J' . ($rowEndPrintData + 8))
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                    ->setVertical(Alignment::VERTICAL_BOTTOM);

                $sheet->setSelectedCell('A1');
            }
        ];
    }

    /**
     * Set height rows
     *
     * @param Worksheet $sheet
     * @param int $startRow row start
     * @param int $endRow row finish
     * @param float $height row height
     */
    private function setRowHeights(Worksheet $sheet, int $startRow, int $endRow, float $height): void
    {
        for ($i = $startRow; $i <= $endRow; $i++) {
            $sheet->getRowDimension($i)->setRowHeight($height);
        }
    }
}
