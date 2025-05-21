<?php

use App\Http\Controllers\Admin\HumanResourcesController;
use App\Http\Controllers\Admin\ProjectAssignmentController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TimekeepingController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

/* Un-authenticated. */
Route::group(['middleware' => ['guest']], function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('auth.showLogin');
    Route::post('login', [AuthController::class, 'processLogin'])->name('auth.processLogin');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('pages.dashboard');

    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');

    /* Timesheet. */
    Route::prefix('timesheet')->group(function () {
        Route::prefix('timekeeping')->name('timesheet.timekeeping.')->group(function () {
            Route::get('timesheet-detail', [TimekeepingController::class, 'showPageDetailedTimesheet'])->name('showPageDetailedTimesheet');
            Route::get('timesheet-general', [TimekeepingController::class, 'showPageGeneralTimesheet'])->name('showPageGeneralTimesheet');
            Route::get('timekeeping-data', [TimekeepingController::class, 'showPageTimekeepingData'])->name('showPageTimekeepingData');
        });
    });

    /* Project. */
    Route::get('projects', [ProjectController::class, 'showProjectList'])->name('project.showProjectList');
    Route::get('projects/create', [ProjectController::class, 'showCreateProjectForm'])->name('project.showCreateProjectForm');
    Route::get('projects/update/{projectId}', [ProjectController::class, 'showUpdateProjectForm'])->name('project.showUpdateProjectForm');

    Route::get('projects/project-assign', [ProjectAssignmentController::class, 'showProjectAssignment'])->name('project.showProjectAssignment');
    Route::get('projects/project-assign-detail/{projectId}', [ProjectAssignmentController::class, 'showProjectAssignmentDetail'])->name('project.showProjectAssignmentDetail');

    Route::get('projects/project-report1', [ProjectController::class, 'showProjectReport1'])->name('project.report.showProjectReport1');
    Route::get('projects/project-report2', [ProjectController::class, 'showProjectReport2'])->name('project.report.showProjectReport2');
    Route::post('projects/project-report', [ProjectController::class, 'exportReport'])->name('project.report.exportReport');

    /* Employee. */
    Route::get('employees', [HumanResourcesController::class, 'showEmployeeList'])->name('employee.showEmployeeList');
    Route::get('employees/create', [HumanResourcesController::class, 'showCreateEmployeeForm'])->name('employee.showCreateEmployeeForm');
});


