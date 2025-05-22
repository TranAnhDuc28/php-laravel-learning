<?php

use App\Http\Controllers\Admin\HumanResourcesController;
use App\Http\Controllers\Admin\ProjectAssignmentController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ReportController;
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
    Route::get('profile', [AuthController::class, 'showProfile'])->name('auth.showProfile');
    Route::get('change-password', [AuthController::class, 'showChangePassword'])->name('auth.showChangePassword');
    Route::post('change-password', [AuthController::class, 'processChangePassword'])->name('auth.processChangePassword');

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
    Route::get('projects/create', [ProjectController::class, 'showCreateProject'])->name('project.showCreateProject');
    Route::post('projects/create', [ProjectController::class, 'processCreateProject'])->name('project.processCreateProject');
    Route::get('projects/update/{projectId}', [ProjectController::class, 'showUpdateProject'])->name('project.showUpdateProject');
    Route::put('projects/update/{projectId}', [ProjectController::class, 'processUpdateProject'])->name('project.processUpdateProject');

    Route::get('projects/project-assign', [ProjectAssignmentController::class, 'showProjectAssignment'])->name('project.showProjectAssignment');
    Route::get('projects/project-assign-detail/{projectId}', [ProjectAssignmentController::class, 'showProjectAssignmentDetail'])->name('project.showProjectAssignmentDetail');

    Route::get('projects/report/monthly-payment-request', [ReportController::class, 'showMonthlyPaymentRequest'])->name('project.report.showMonthlyPaymentRequest');
    Route::get('projects/report/project-payment-request', [ReportController::class, 'showProjectPaymentRequest'])->name('project.report.showProjectPaymentRequest');
    Route::get('projects/report/export/monthly-payment-request', [ReportController::class, 'exportReport'])->name('project.report.exportMonthlyPaymentRequest');
    Route::get('projects/report/export/project-payment-request', [ReportController::class, 'exportReport'])->name('project.report.exportProjectPaymentRequest');

    /* Employee. */
    Route::get('employees', [HumanResourcesController::class, 'showEmployeeList'])->name('employee.showEmployeeList');
    Route::get('employees/create', [HumanResourcesController::class, 'showCreateEmployee'])->name('employee.showCreateEmployee');
    Route::post('employees/create', [HumanResourcesController::class, 'processCreateEmployee'])->name('employee.processCreateEmployee');
    Route::get('employees/update/{id}', [HumanResourcesController::class, 'showUpdateEmployee'])->name('employee.showUpdateEmployee');
    Route::put('employees/update/{id}', [HumanResourcesController::class, 'processUpdateEmployee'])->name('employee.processUpdateEmployee');
});

