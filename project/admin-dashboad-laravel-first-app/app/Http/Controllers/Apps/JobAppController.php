<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class JobAppController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showStatistics() {
        return view('apps.jobs.statistics');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showJobList() {
        return view('apps.jobs.job_list.list');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showJobGridList() {
        return view('apps.jobs.job_list.grid');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showJobOverview() {
        return view('apps.jobs.job_list.overview');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showCandidateListView() {
        return view('apps.jobs.candidate_lists.list');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showCandidateGridView() {
        return view('apps.jobs.candidate_lists.grid');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showApplication() {
        return view('apps.jobs.application');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showNewJob() {
        return view('apps.jobs.new_job');
    }


    /**
     * @return Factory|View|Application|object
     */
    public function showCompaniesList() {
        return view('apps.jobs.companies_list');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showJobCategories() {
        return view('apps.jobs.job_categories');
    }
}
