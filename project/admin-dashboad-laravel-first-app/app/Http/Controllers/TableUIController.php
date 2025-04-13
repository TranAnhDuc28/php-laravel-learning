<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class TableUIController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showTableBasic()
    {
        return view('tables.basic');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showTableGridJs()
    {
        return view('tables.gridjs');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showTableListJs()
    {
        return view('tables.listjs');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showDataTables()
    {
        return view('tables.datatables');
    }
}
