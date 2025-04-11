<?php

namespace App\Exports\Sheets;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SheetTest implements FromCollection, WithTitle, ShouldAutoSize, WithHeadings, WithStyles
{
    private $month;
    private $year;

    public function __construct(int $year, string $month)
    {
        $this->month = $month;
        $this->year  = $year;
    }

    /**
     * @return Collection|\Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::all();
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->month . '_' . $this->year;
    }

    /**
     * @return string[]
     */
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Email Verified At',
            'Created At',
            'Updated At',
        ];
    }

    /**
     * @param Worksheet $sheet
     * @return void
     * @throws Exception
     */
    public function styles(Worksheet $sheet)
    {
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ];

        $sheet->getStyle('A1:F11')->applyFromArray($styleArray);
    }
}
