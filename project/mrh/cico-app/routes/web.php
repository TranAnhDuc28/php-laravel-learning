<?php

use App\Http\Controllers\ApplicationFormController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CheckInOutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DaysOffController;
use App\Http\Controllers\LeaveDayController;
use App\Http\Controllers\OvertimeFormController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ProjectUserController;
use App\Http\Controllers\SkillCategoryController;
use App\Http\Controllers\SkillItemController;
use App\Http\Controllers\SkillManagerController;
use App\Http\Controllers\SkillUserController;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\TeamUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('check-in-out/patch', [CheckInOutController::class, 'patch']);
Route::middleware('auth')->group(function () {
    Route::get('/refresh-csrf', function () {
        return csrf_token();
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::prefix('check-in-out')->group(function () {
        Route::get('/', [CheckInOutController::class, 'index'])->name('check_in_out.index');
        Route::get('/create', [CheckInOutController::class, 'create'])->name('check_in_out.create');
        Route::post('/store/', [CheckInOutController::class, 'store'])->name('check_in_out.store');
        Route::get('/{checkInOut}', [CheckInOutController::class, 'show'])->name('check_in_out.show');
        Route::get('/{checkInOut}/edit', [CheckInOutController::class, 'edit'])->name('check_in_out.edit');
        Route::post('/update/', [CheckInOutController::class, 'update'])->name('check_in_out.update');
//        Route::patch('/patch', [CheckInOutController::class, 'check_in_out.patch']);
//        Route::put('/{checkInOut}', [CheckInOutController::class, 'update'])->name('check_in_out.update');
        Route::delete('/{checkInOut}', [CheckInOutController::class, 'destroy'])->name('check_in_out.destroy');
    });
//    Route::get('/check-in-out', [CheckInOutController::class, 'index'])->name('checkinout.index');
//    Route::get('/check-in-out', [CheckInOutController::class, 'create'])->name('checkinout.create');
//    Route::get('/check-in-out', [CheckInOutController::class, 'show'])->name('checkinout.show');
//    Route::get('/check-in-out', [CheckInOutController::class, 'edit'])->name('checkinout.edit');
//    Route::post('/check-in-out', [CheckInOutController::class, 'store'])->name('checkinout.store');
//    Route::patch('/check-in-out', [CheckInOutController::class, 'update'])->name('checkinout.update');
//    Route::delete('/check-in-out', [CheckInOutController::class, 'destroy'])->name('checkinout.destroy');
    Route::prefix('application-forms')->group(function () {
        Route::get('/', [ApplicationFormController::class, 'index'])->name('application-forms.index');
        Route::get('/create', [ApplicationFormController::class, 'create'])->name('application-forms.create');
        Route::post('/store', [ApplicationFormController::class, 'store'])->name('application-forms.store');
//        Route::get('/{applicationForm}', [ApplicationFormController::class, 'show'])->name('application-forms.show');
//        Route::get('/{applicationForm}/edit', [ApplicationFormController::class, 'edit'])->name('application-forms.edit');
//        Route::put('/{applicationForm}/update', [ApplicationFormController::class, 'update'])->name('application-forms.update');
        Route::delete('/{applicationForm}', [ApplicationFormController::class, 'destroy'])->name('application-forms.destroy');
        Route::get('/list', [ApplicationFormController::class, 'list'])->name('application-forms.list');
        Route::post('/approval', [ApplicationFormController::class, 'approval'])->name('application-forms.approval');
    });
    Route::prefix('overtime-forms')->group(function () {
        Route::get('/', [OvertimeFormController::class, 'index'])->name('overtime-forms.index');
        Route::get('/create', [OvertimeFormController::class, 'create'])->name('overtime-forms.create');
        Route::post('/store', [OvertimeFormController::class, 'store'])->name('overtime-forms.store');
//        Route::get('/{overtimeForm}', [OvertimeFormController::class, 'show'])->name('overtime-forms.show');
        Route::get('/{overtimeForm}/edit', [OvertimeFormController::class, 'edit'])->name('overtime-forms.edit');
        Route::post('/update', [OvertimeFormController::class, 'update'])->name('overtime-forms.update');
        Route::delete('/{overtimeForm}', [OvertimeFormController::class, 'destroy'])->name('overtime-forms.destroy');
        Route::get('/list', [OvertimeFormController::class, 'list'])->name('overtime-forms.list');
        Route::post('/approval', [OvertimeFormController::class, 'approval'])->name('overtime-forms.approval');
        Route::post('/info', [OvertimeFormController::class, 'info'])->name('overtime-forms.info');
    });
});

Route::middleware(['auth', 'admin.mod'])->group(function () {
    Route::prefix('management')->group(function () {
//        Route::get('/check-in-out/preview', [CheckInOutController::class, 'preview'])->name('check_in_out.preview');
//        Route::post('/check-in-out/change', [CheckInOutController::class, 'change'])->name('check_in_out.change');
        Route::get('/check-in-out', [CheckInOutController::class, 'list'])->name('check_in_out.list');
        Route::get('/leave-days', [LeaveDayController::class, 'list'])->name('leave_days.list');
        Route::get('/days-off/list', [DaysOffController::class, 'list'])->name('days-off.list');
        Route::get('/days-off/create', [DaysOffController::class, 'create'])->name('days-off.create');
        Route::delete('/days-off/{id}', [DaysOffController::class, 'destroy'])->name('days-off.destroy');
        Route::post('/days-off', [DaysOffController::class, 'store'])->name('days-off.store');
//        Route::get('/application-forms', [ApplicationFormController::class, 'list'])->name('application-forms.list');
//        Route::post('/application-forms/approval', [ApplicationFormController::class, 'approval'])->name('application-forms.approval');
//        Route::get('/overtime-forms', [OvertimeFormController::class, 'list'])->name('overtime-forms.list');
//        Route::post('/overtime-forms/approval', [OvertimeFormController::class, 'list'])->name('overtime-forms.approval');
    });
    Route::prefix('user')->group(function () {
        Route::get('/', [RegisteredUserController::class, 'index'])->name('user.index');
        Route::get('/register', [RegisteredUserController::class, 'create'])
            ->name('register');
        Route::post('/register', [RegisteredUserController::class, 'store']);
        Route::get('/{id}/edit', [RegisteredUserController::class, 'edit'])->name('user.edit');
        Route::put('/{id}', [RegisteredUserController::class, 'update'])->name('user.update');
        Route::delete('/{id}', [RegisteredUserController::class, 'destroy'])->name('user.destroy');
    });

    Route::prefix('teams')->group(function () {
        Route::get('/', [TeamsController::class, 'index'])->name('teams.index');
        Route::get('/create', [TeamsController::class, 'create'])->name('teams.create');
        Route::post('/store', [TeamsController::class, 'store'])->name('teams.store');
        Route::get('/{teams}', [TeamsController::class, 'show'])->name('teams.show');
        Route::get('/{teams}/edit', [TeamsController::class, 'edit'])->name('teams.edit');
        Route::put('/{teams}/update', [TeamsController::class, 'update'])->name('teams.update');
        Route::delete('/{teams}', [TeamsController::class, 'destroy'])->name('teams.destroy');
    });

    Route::prefix('team-user')->group(function () {
        Route::get('/', [TeamUserController::class, 'index'])->name('team-user.index');
//        Route::get('/create', [TeamUserController::class, 'create'])->name('team-user.create');
//        Route::post('/store', [TeamUserController::class, 'store'])->name('team-user.store');
//        Route::get('/{teamUser}', [TeamUserController::class, 'show'])->name('team-user.show');
//        Route::get('/{teamUser}/edit', [TeamUserController::class, 'edit'])->name('team-user.edit');
        Route::post('/update', [TeamUserController::class, 'update'])->name('team-user.update');
//        Route::put('/{teamUser}/update', [TeamUserController::class, 'update'])->name('team-user.update');
//        Route::delete('/{teamUser}', [TeamUserController::class, 'destroy'])->name('team-user.destroy');
    });

    Route::prefix('projects')->group(function () {
        Route::get('/', [ProjectsController::class, 'index'])->name('projects.index');
        Route::get('/create', [ProjectsController::class, 'create'])->name('projects.create');
        Route::post('/store', [ProjectsController::class, 'store'])->name('projects.store');
        Route::get('/{projects}', [ProjectsController::class, 'show'])->name('projects.show');
        Route::get('/{projects}/edit', [ProjectsController::class, 'edit'])->name('projects.edit');
        Route::put('/{projects}/update', [ProjectsController::class, 'update'])->name('projects.update');
        Route::delete('/{projects}', [ProjectsController::class, 'destroy'])->name('projects.destroy');
    });

//    Route::prefix('leave-days')->group(function () {
//        Route::get('/', [LeaveDayController::class, 'index'])->name('leave-days.index');
//        Route::get('/create', [LeaveDayController::class, 'create'])->name('leave-days.create');
//        Route::post('/store', [LeaveDayController::class, 'store'])->name('leave-days.store');
//        Route::get('/{leave-days}', [LeaveDayController::class, 'show'])->name('leave-days.show');
//        Route::get('/{leave-days}/edit', [LeaveDayController::class, 'edit'])->name('leave-days.edit');
//        Route::put('/{leave-days}/update', [LeaveDayController::class, 'update'])->name('leave-days.update');
//        Route::delete('/{leave-days}', [LeaveDayController::class, 'destroy'])->name('leave-days.destroy');
//    });

    Route::prefix('project-user')->group(function () {
        Route::get('/', [ProjectUserController::class, 'index'])->name('project-user.index');
        Route::post('/update', [ProjectUserController::class, 'update'])->name('project-user.update');
    });
});

Route::middleware(['auth', 'pu'])->group(function () {
    Route::prefix('management')->group(function () {
        Route::get('/check-in-out/preview', [CheckInOutController::class, 'preview'])->name('check_in_out.preview');
        Route::post('/check-in-out/change', [CheckInOutController::class, 'change'])->name('check_in_out.change');
    });
});

Route::middleware(['auth', 'admin.pu'])->group(function () {
    Route::get('/skill-category', [SkillCategoryController::class, 'index'])->name('skill-category.index');
    Route::get('/skill-category/create', [SkillCategoryController::class, 'create'])->name('skill-category.create');
    Route::post('/skill-category/create', [SkillCategoryController::class, 'processCreate'])->name('skill-category.processCreate');
    Route::get('/skill-category/update/{id}', [SkillCategoryController::class, 'update'])->where('id', '[0-9]{0,9}')->name('skill-category.update');
    Route::post('/skill-category/update/{id}', [SkillCategoryController::class, 'processUpdate'])->where('id', '[0-9]{0,9}')->name('skill-category.processUpdate');
    Route::post('/skill-category/delete/{id}', [SkillCategoryController::class, 'processDelete'])->where('id', '[0-9]{0,9}')->name('skill-category.processDelete');

    Route::get('/skill-item', [SkillItemController::class, 'index'])->name('skill-item.index');
    Route::get('/skill-item/create', [SkillItemController::class, 'create'])->name('skill-item.create');
    Route::post('/skill-item/create', [SkillItemController::class, 'processCreate'])->name('skill-item.processCreate');
    Route::get('/skill-item/update/{id}', [SkillItemController::class, 'update'])->where('id', '[0-9]{0,9}')->name('skill-item.update');
    Route::post('/skill-item/update/{id}', [SkillItemController::class, 'processUpdate'])->where('id', '[0-9]{0,9}')->name('skill-item.processUpdate');
    Route::post('/skill-item/delete/{id}', [SkillItemController::class, 'processDelete'])->where('id', '[0-9]{0,9}')->name('skill-item.processDelete');

    Route::get('/skill/list', [SkillUserController::class, 'index'])->name('skill-user.list');

});

Route::middleware('auth')->group(function () {
    Route::get('/skill', [SkillUserController::class, 'show'])->name('skill-user.show');
    Route::get('/skill/export/{user?}', [SkillUserController::class, 'export'])->name('skill-user.export');

    Route::get('/skill/edit/{user_id?}', [SkillUserController::class, 'edit'])->name('skill-user.edit');
    Route::post('/skill/edit/{user_id?}', [SkillUserController::class, 'processEdit'])->name('skill-user.processEdit');

});

require __DIR__ . '/auth.php';
