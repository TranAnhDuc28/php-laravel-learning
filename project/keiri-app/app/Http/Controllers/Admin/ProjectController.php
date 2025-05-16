<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ExportExcelDemo;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ProjectController extends Controller
{
    public function showProjectList()
    {
        return view('pages.project.project_list');
    }

    public function showCreateProjectForm()
    {
        return view('pages.project.project_create');
    }

    public function showProjectAssignment()
    {
        return view('pages.project.project_assignment');
    }

    public function showProjectReport()
    {
        return view('pages.project.report');
    }

    /**
     * @return BinaryFileResponse
     */
    public function exportReport(Request $request)
    {
        return Excel::download(new ExportExcelDemo(), 'report_' . Carbon::now() . '.xlsx');
    }
}
