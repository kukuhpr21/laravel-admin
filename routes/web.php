<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MappingRoleMenuController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DashboardController::class, 'index'])->middleware("session.exist");
Route::get('dashboard', [DashboardController::class, 'index'])->middleware("session.exist");
Route::get('signout', [AuthController::class, 'signout'])->name('signout');

Route::prefix('signin')->group(function () {
    Route::get('/', [AuthController::class, 'signIn']);
    Route::post('/', [AuthController::class, 'doSignIn']);
});

Route::prefix('change-password')->group(function () {
    Route::get('/', [AuthController::class, 'changePassword']);
    Route::post('/', [AuthController::class, 'doChangePassword']);
});

Route::prefix('roles')->group(function () {

    Route::get('/', [RoleController::class, 'index'])->name('roles')->middleware("session.exist");

    Route::prefix('create')->group(function () {
        Route::get('/', [RoleController::class, 'create'])->name('create-role')->middleware("session.exist");
        Route::post('/', [RoleController::class, 'store'])->name('create-role')->middleware("session.exist");
    });

    Route::prefix('edit')->group(function () {
        Route::get('{id}', [RoleController::class, 'edit'])->name('edit-role')->middleware("session.exist");
        Route::post('{id}', [RoleController::class, 'update'])->name('edit-role')->middleware("session.exist");
    });

    Route::get('delete/{id}', [RoleController::class, 'destroy'])->name('delete-role')->middleware("session.exist");
});

Route::prefix('menus')->group(function () {

    Route::get('/', [MenuController::class, 'index'])->name('menus')->middleware("session.exist");

    Route::prefix('create')->group(function () {
        Route::get('/', [MenuController::class, 'create'])->name('create-menu')->middleware("session.exist");
        Route::post('/', [MenuController::class, 'store'])->name('create-menu')->middleware("session.exist");
    });

    Route::prefix('edit')->group(function () {
        Route::get('{id}', [MenuController::class, 'edit'])->name('edit-menu')->middleware("session.exist");
        Route::post('{id}', [MenuController::class, 'update'])->name('edit-menu')->middleware("session.exist");
    });

    Route::get('delete/{id}', [MenuController::class, 'destroy'])->name('delete-menu')->middleware("session.exist");
});

Route::prefix('mapping-role-menu')->group(function () {

    Route::get('/', [MappingRoleMenuController::class, 'index'])
        ->name('role-menu')->middleware("session.exist");

    Route::prefix('create')->group(function () {
        Route::get('/', [MappingRoleMenuController::class, 'create'])
            ->name('create-mapping-role-menu')->middleware("session.exist");
        Route::post('/', [MappingRoleMenuController::class, 'store'])
            ->name('create-mapping-role-menu')->middleware("session.exist");
    });

    Route::post('show', [MappingRoleMenuController::class, 'show'])
        ->name('view-mapping-role-menu')->middleware("session.exist");
});
