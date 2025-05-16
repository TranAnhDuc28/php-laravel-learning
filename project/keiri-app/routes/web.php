<?php

use App\Http\Controllers\Admin\HumanResourcesController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TimekeepingController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('login', [AuthController::class, 'showLogin'])->name('auth.showLogin');
Route::post('login', [AuthController::class, 'processLogin'])->name('auth.processLogin');
Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('pages.dashboard');

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
Route::get('projects/project-assignment', [ProjectController::class, 'showProjectAssignment'])->name('project.showProjectAssignment');
Route::get('projects/project-report', [ProjectController::class, 'showProjectReport'])->name('project.showProjectReport');
Route::post('projects/project-report', [ProjectController::class, 'exportReport'])->name('project.exportReport');

/* Employee. */
Route::get('employees', [HumanResourcesController::class, 'showEmployeeList'])->name('employee.showEmployeeList');
Route::get('employees/create', [HumanResourcesController::class, 'showCreateEmployeeForm'])->name('employee.showCreateEmployeeForm');
