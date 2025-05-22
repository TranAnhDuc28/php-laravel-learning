<?php

namespace App\Exports;

use App\Exports\Sheets\SheetBilling;
use App\Exports\Sheets\SheetReportDailyMonth;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ExportExcelMonthlyPaymentRequest implements WithMultipleSheets
{
    /**
     * @return array
     */
    public function sheets(): array
    {
        $data = [
            [
                'name' => 'Kashiwagi Takeshi',
                'rank' => 'JPM',
                'monthly_price' => 600000,
                'hourly_price' => 0,
                'overtime' => 0,
                'description' => 'TX様ODC契約内プロジェクト、RSS東西、VACのプロジェクトマネジメント'
            ],
            [
                'name' => 'Nguyen Tien Dung',
                'rank' => 'PS_GM',
                'monthly_price' => 300000,
                'hourly_price' => 0,
                'overtime' => 0,
                'description' => 'SFDCの2プロジェクト（WOWOWとNGB）でのマネジメント'
            ],
            [
                'name' => 'Kieu Bao Long',
                'rank' => 'PL',
                'monthly_price' => 300000,
                'hourly_price' => 0,
                'overtime' => 0,
                'description' => '音声マイニングシステム機能追加とプロジェクトマネジメント'
            ],
            [
                'name' => 'Tran Tuan Long',
                'rank' => 'PL',
                'monthly_price' => 300000,
                'hourly_price' => 0,
                'overtime' => 0,
                'description' => 'mietenプロジェクトリーダ、CiMAプロジェクトマネジメント'
            ],
            [
                'name' => 'Do Huu Tuan',
                'rank' => 'PS_PM',
                'monthly_price' => 180000,
                'hourly_price' => 0,
                'overtime' => 0,
                'description' => 'SFDC,WOWOWプロジェクトの開発PM'
            ],
            [
                'name' => 'Ngyuen Tien Trung',
                'rank' => 'PS_PL',
                'monthly_price' => 120000,
                'hourly_price' => 0,
                'overtime' => 0,
                'description' => 'SFDC,NGBプロジェクトの開発リーダ'
            ],
            [
                'name' => 'Nguyen Anh Tuan',
                'rank' => 'PS_SE',
                'monthly_price' => 80000,
                'hourly_price' => 0,
                'overtime' => 0,
                'description' => 'SFDC,NGBプロジェクトの開発'
            ],
            [
                'name' => 'Nguyen Minh Vu',
                'rank' => 'SE',
                'monthly_price' => 150000,
                'hourly_price' => 0,
                'overtime' => 0,
                'description' => '音声マイニングシステム機能追加'
            ],
            [
                'name' => 'Bui Thi Thom',
                'rank' => 'SE',
                'monthly_price' => 150000,
                'hourly_price' => 0,
                'overtime' => 0,
                'description' => 'ドコモ通知機能開発'
            ],
            [
                'name' => 'Ngyurn Thanh Minh',
                'rank' => 'SE',
                'monthly_price' => 140000,
                'hourly_price' => 0,
                'overtime' => 0,
                'description' => 'RSS東西システム更改開発'
            ],
            [
                'name' => 'Ngyuen Thanh Trung',
                'rank' => 'SE',
                'monthly_price' => 130000,
                'hourly_price' => 0,
                'overtime' => 0,
                'description' => 'ドコモ通知機能開発'
            ],
            [
                'name' => 'Pham Long Quan',
                'rank' => 'SE',
                'monthly_price' => 100000,
                'hourly_price' => 0,
                'overtime' => 0,
                'description' => '本社向け人事管理処理機能の自動化'
            ],
            [
                'name' => 'Do Tuan Thanh',
                'rank' => 'SE',
                'monthly_price' => 100000,
                'hourly_price' => 0,
                'overtime' => 0,
                'description' => '音声マイニングシステム機能追加'
            ],
            [
                'name' => 'Bui Hong Khnah',
                'rank' => 'SE',
                'monthly_price' => 150000,
                'hourly_price' => 0,
                'overtime' => 0,
                'description' => '興研機能追加'
            ],
            [
                'name' => 'Nguyen Hai Anh',
                'rank' => 'PG',
                'monthly_price' => 70000,
                'hourly_price' => 0,
                'overtime' => 0,
                'description' => 'CiMAプロジェクトUT実施'
            ],
            [
                'name' => 'Hoang Quang Linh',
                'rank' => 'PG',
                'monthly_price' => 70000,
                'hourly_price' => 0,
                'overtime' => 0,
                'description' => '音声マイニングシステム機能追加'
            ],
            [
                'name' => 'Luu Thi Hai Yen',
                'rank' => 'PG',
                'monthly_price' => 70000,
                'hourly_price' => 0,
                'overtime' => 0,
                'description' => 'CiMAプロジェクトUT実施'
            ],
            [
                'name' => 'Nguyen Tuan Anh',
                'rank' => 'PG',
                'monthly_price' => 60000,
                'hourly_price' => 0,
                'overtime' => 0,
                'description' => 'CiMAプロジェクトUT実施'
            ],
            [
                'name' => 'Pham Van Dat',
                'rank' => 'PS_PG',
                'monthly_price' => 80000,
                'hourly_price' => 0,
                'overtime' => 0,
                'description' => 'SFDC,WOWOWプロジェクトの開発'
            ],
            [
                'name' => 'Hoang Thi Hien',
                'rank' => 'CM',
                'monthly_price' => 80000,
                'hourly_price' => 0,
                'overtime' => 0,
                'description' => 'mieten、CiMAプロジェクトの通訳、翻訳'
            ],
            [
                'name' => 'Tran Minh Hang',
                'rank' => 'CM',
                'monthly_price' => 80000,
                'hourly_price' => 0,
                'overtime' => 0,
                'description' => '音声マイニングシステム、RSS東西の通訳、翻訳'
            ],
        ];

        $sheets = [];
        $titleReportDailySheets = [];
        $year = 2024;

        for ($month = 9; $month <= 12; $month++) {
            $month_M = Carbon::now()->month($month)->format('M');
            $sheets[] = new SheetReportDailyMonth($year, $month_M, $data);
            $titleReportDailySheets[] = '2.' . $month_M . '_' . $year;
        }

        $sheets[] = new SheetBilling($titleReportDailySheets);

        return $sheets;
    }
}
