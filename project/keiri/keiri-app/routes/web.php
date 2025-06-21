<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HumanResourcesController;
use App\Http\Controllers\Admin\ProjectAssignmentController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\TimekeepingController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;

/* Language switcher. */
Route::get('language/{locale}', [LanguageController::class, 'switchLanguage'])->name('language');

/* Un-authenticated. */
Route::group(['middleware' => ['guest', 'locale']], function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('auth.showLogin');
    Route::post('login', [AuthController::class, 'processLogin'])->name('auth.processLogin');
});

Route::group(['middleware' => ['locale']], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('pages.dashboard');

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

    /* Employee. */
//    Route::group(['middleware' => ['check_role:' . implode(',', [UserRole::ADMIN->value])]], function () {
        Route::get('employees', [HumanResourcesController::class, 'showEmployeeList'])->name('employee.showEmployeeList');
        Route::get('employees/create', [HumanResourcesController::class, 'showCreateEmployee'])->name('employee.showCreateEmployee');
        Route::post('employees/create', [HumanResourcesController::class, 'processCreateEmployee'])->name('employee.processCreateEmployee');
        Route::get('employees/update/{id}', [HumanResourcesController::class, 'showUpdateEmployee'])->name('employee.showUpdateEmployee');
        Route::put('employees/update/{id}', [HumanResourcesController::class, 'processUpdateEmployee'])->name('employee.processUpdateEmployee');
        Route::get('employees/employee-payment-costs', [HumanResourcesController::class, 'showEmployeePaymentCosts'])->name('employee.showEmployeePaymentCosts');
//    });

    /* Project. */
//    Route::group(['middleware' => ['check_role:' . UserRole::ADMIN->value]], function () {
        Route::get('projects', [ProjectController::class, 'showProjectList'])->name('project.showProjectList');
        Route::get('projects/create', [ProjectController::class, 'showCreateProject'])->name('project.showCreateProject');
        Route::post('projects/create', [ProjectController::class, 'processCreateProject'])->name('project.processCreateProject');
        Route::get('projects/update/{projectId}', [ProjectController::class, 'showUpdateProject'])->name('project.showUpdateProject');
        Route::put('projects/update/{projectId}', [ProjectController::class, 'processUpdateProject'])->name('project.processUpdateProject');

        Route::get('projects/project-assign', [ProjectAssignmentController::class, 'showProjectAssignment'])->name('project.assign.showProjectAssignment');
        Route::get('projects/project-assign/detail/{projectId}', [ProjectAssignmentController::class, 'showProjectAssignmentDetail'])->name('project.assign.showProjectAssignmentDetail');
        Route::get('projects/project-assign/update-member/{projectAssignId}', [ProjectAssignmentController::class, 'showUpdateMemberAssignment'])->name('project.assign.showUpdateMemberAssignment');
        Route::put('projects/project-assign/update-member/{projectAssignId}', [ProjectAssignmentController::class, 'processUpdateProjectAssignmentLog'])->name('project.assign.processUpdateProjectAssignmentLog');
        Route::post('projects/project-assign/delete-log/{projectAssignLogId}', [ProjectAssignmentController::class, 'processDelete'])->name('project.assign.processDeleteProjectAssignmentLog');
//    });

    /* Report. */
//    Route::group(['middleware' => ['check_role:' . UserRole::ADMIN->value]], function () {
        Route::get('reports/monthly-payment-request', [ReportController::class, 'showMonthlyPaymentRequest'])->name('report.showMonthlyPaymentRequest');
        Route::get('reports/project-payment-request', [ReportController::class, 'showProjectPaymentRequest'])->name('report.showProjectPaymentRequest');
        Route::get('reports/export/monthly-payment-request', [ReportController::class, 'exportReport'])->name('report.exportMonthlyPaymentRequest');
        Route::get('reports/export/project-payment-request', [ReportController::class, 'exportReport'])->name('report.exportProjectPaymentRequest');
//    });
});

