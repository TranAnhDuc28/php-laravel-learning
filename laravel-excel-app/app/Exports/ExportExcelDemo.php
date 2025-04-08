<?php

namespace App\Exports;

use App\Exports\Sheets\SheetDemo;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ExportExcelDemo implements WithMultipleSheets
{
    /**
     * @return array
     */
    public function sheets(): array
    {
        $data = [
            [
                'name' => 'Nguyen Tien Dung',
                'rank' => 'PS_PG',
                'monthly_price' => 0,
                'hourly_price' => 0,
                'overtime' => 10,
                'description' => 'SFDCプロジェクト(WOWWOW)',
            ],
            [
                'name' => 'Tran Van Binh',
                'rank' => 'SE',
                'monthly_price' => 550000,
                'hourly_price' => 2000,
                'overtime' => 5,
                'description' => '販売管理システム改修',
            ],
            [
                'name' => 'Nguyen Thi Lan',
                'rank' => 'PG',
                'monthly_price' => 450000,
                'hourly_price' => 1500,
                'overtime' => 12,
                'description' => 'モバイルアプリ開発支援',
            ],
            [
                'name' => 'Pham Van Hoang',
                'rank' => 'CM',
                'monthly_price' => 400000,
                'hourly_price' => 1000,
                'overtime' => 8,
                'description' => '翻訳・通訳業務',
            ],
            [
                'name' => 'Le Thi Thu',
                'rank' => 'PG',
                'monthly_price' => 480000,
                'hourly_price' => 1300,
                'overtime' => 6,
                'description' => 'ECサイトテスト実施・報告',
            ],
            [
                'name' => 'Hoang Minh Duc',
                'rank' => 'PM',
                'monthly_price' => 700000,
                'hourly_price' => 2500,
                'overtime' => 3,
                'description' => 'プロジェクト全体管理',
            ],
            [
                'name' => 'Nguyen Tien Dung',
                'rank' => 'PS_PG',
                'monthly_price' => 0,
                'hourly_price' => 0,
                'overtime' => 10,
                'description' => 'SFDCプロジェクト(WOWWOW)',
            ],
            [
                'name' => 'Tran Van Binh',
                'rank' => 'SE',
                'monthly_price' => 550000,
                'hourly_price' => 2000,
                'overtime' => 5,
                'description' => '販売管理システム改修',
            ],
            [
                'name' => 'Nguyen Thi Lan',
                'rank' => 'PG',
                'monthly_price' => 450000,
                'hourly_price' => 1500,
                'overtime' => 12,
                'description' => 'モバイルアプリ開発支援',
            ],
            [
                'name' => 'Pham Van Hoang',
                'rank' => 'CM',
                'monthly_price' => 400000,
                'hourly_price' => 1000,
                'overtime' => 8,
                'description' => '翻訳・通訳業務',
            ],
            [
                'name' => 'Le Thi Thu',
                'rank' => 'PG',
                'monthly_price' => 480000,
                'hourly_price' => 1300,
                'overtime' => 6,
                'description' => 'ECサイトテスト実施・報告',
            ],
            [
                'name' => 'Hoang Minh Duc',
                'rank' => 'PM',
                'monthly_price' => 700000,
                'hourly_price' => 2500,
                'overtime' => 3,
                'description' => 'プロジェクト全体管理',
            ],
            [
                'name' => 'Nguyen Tien Dung',
                'rank' => 'PS_PG',
                'monthly_price' => 0,
                'hourly_price' => 0,
                'overtime' => 10,
                'description' => 'SFDCプロジェクト(WOWWOW)',
            ],
            [
                'name' => 'Tran Van Binh',
                'rank' => 'SE',
                'monthly_price' => 550000,
                'hourly_price' => 2000,
                'overtime' => 5,
                'description' => '販売管理システム改修',
            ],
            [
                'name' => 'Nguyen Thi Lan',
                'rank' => 'PG',
                'monthly_price' => 450000,
                'hourly_price' => 1500,
                'overtime' => 12,
                'description' => 'モバイルアプリ開発支援',
            ],
            [
                'name' => 'Pham Van Hoang',
                'rank' => 'CM',
                'monthly_price' => 400000,
                'hourly_price' => 1000,
                'overtime' => 8,
                'description' => '翻訳・通訳業務',
            ],
            [
                'name' => 'Le Thi Thu',
                'rank' => 'PG',
                'monthly_price' => 480000,
                'hourly_price' => 1300,
                'overtime' => 6,
                'description' => 'ECサイトテスト実施・報告',
            ],
            [
                'name' => 'Hoang Minh Duc',
                'rank' => 'PM',
                'monthly_price' => 700000,
                'hourly_price' => 2500,
                'overtime' => 3,
                'description' => 'プロジェクト全体管理',
            ],
        ];

        $sheets = [];
        $year = Carbon::now()->year;

        for ($month = 1; $month <= 12; $month++) {
            $sheets[] = new SheetDemo($year, Carbon::now()->month($month)->format('M'), $data);
        }

        return $sheets;
    }
}
