<?php

use App\Http\Controllers\BudgetController;
use App\Http\Controllers\BudgetTypeController;
use App\Http\Controllers\DashboardDailyController;
use App\Http\Controllers\DashboardMonthlyController;
use App\Http\Controllers\DashboardOtherController;
use App\Http\Controllers\DashboardYearlyController;
use App\Http\Controllers\GrpoController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncomingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MigiController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PowithetaController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');

    Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('/users/data', [UserController::class, 'data'])->name('users.data');
    Route::resource('users', UserController::class);
});

Route::middleware('auth')->prefix('roles')->name('roles.')->group(function () {
    Route::get('/', [RoleController::class, 'index'])->name('index');
    Route::get('/create', [RoleController::class, 'create'])->name('create');
    Route::post('/', [RoleController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [RoleController::class, 'edit'])->name('edit');
    Route::put('/{id}', [RoleController::class, 'update'])->name('update');
});

Route::middleware('auth')->prefix('permissions')->name('permissions.')->group(function () {
    Route::get('/', [PermissionController::class, 'index'])->name('index');
    Route::post('/', [PermissionController::class, 'store'])->name('store');
});

Route::middleware('auth')->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/daily', [DashboardDailyController::class, 'index'])->name('daily.index');

    Route::get('/monthly', [DashboardMonthlyController::class, 'index'])->name('monthly.index');
    Route::post('/monthly', [DashboardMonthlyController::class, 'display'])->name('monthly.display');

    Route::get('/yearly', [DashboardYearlyController::class, 'index'])->name('yearly.index');
    Route::post('/yearly', [DashboardYearlyController::class, 'display'])->name('yearly.display');

    Route::get('/other', [DashboardOtherController::class, 'index'])->name('other.index');
    Route::get('/other-grpo', [DashboardOtherController::class, 'grpo'])->name('other.grpo');
    Route::get('/other-test', [DashboardOtherController::class, 'test'])->name('other.test');
});

Route::middleware('auth')->prefix('powitheta')->name('powitheta.')->group(function () {
    Route::get('/export_this_month', [PowithetaController::class, 'export_this_month'])->name('export_this_month');
    Route::get('/export_this_year', [PowithetaController::class, 'export_this_year'])->name('export_this_year');
    Route::get('/data', [PowithetaController::class, 'data'])->name('data');
    Route::get('/data/this_year', [PowithetaController::class, 'data_this_year'])->name('data.this_year');
    Route::get('/', [PowithetaController::class, 'index'])->name('index');
    Route::get('/truncate', [PowithetaController::class, 'truncate'])->name('truncate');
    Route::get('/this_year', [PowithetaController::class, 'index_this_year'])->name('index_this_year');
    Route::get('/{id}', [PowithetaController::class, 'show'])->name('show');
    Route::post('/import_excel', [PowithetaController::class, 'import_excel'])->name('import_excel');
});

Route::middleware('auth')->prefix('grpo')->name('grpo.')->group(function () {
    Route::get('/export_this_month', [GrpoController::class, 'export_this_month'])->name('export_this_month');
    Route::get('/export_this_year', [GrpoController::class, 'export_this_year'])->name('export_this_year');
    Route::get('/data', [GrpoController::class, 'data'])->name('data');
    Route::get('/data/this_year', [GrpoController::class, 'data_this_year'])->name('data.this_year');
    Route::get('/', [GrpoController::class, 'index'])->name('index');
    Route::get('/truncate', [GrpoController::class, 'truncate'])->name('truncate');
    Route::get('/this_year', [GrpoController::class, 'index_this_year'])->name('index_this_year');
    Route::get('/{id}', [GrpoController::class, 'show'])->name('show');
    Route::post('/import_excel', [GrpoController::class, 'import_excel'])->name('import_excel');
});

Route::middleware('auth')->prefix('migi')->name('migi.')->group(function () {
    Route::get('/export_this_month', [MigiController::class, 'export_this_month'])->name('export_this_month');
    Route::get('/export_this_year', [MigiController::class, 'export_this_year'])->name('export_this_year');
    Route::get('/data', [MigiController::class, 'data'])->name('data');
    Route::get('/data/this_year', [MigiController::class, 'data_this_year'])->name('data.this_year');
    Route::get('/', [MigiController::class, 'index'])->name('index');
    Route::get('/truncate', [MigiController::class, 'truncate'])->name('truncate');
    Route::get('/this_year', [MigiController::class, 'index_this_year'])->name('index_this_year');
    Route::get('/{id}', [MigiController::class, 'show'])->name('show');
    Route::post('/import_excel', [MigiController::class, 'import_excel'])->name('import_excel');
});

Route::middleware('auth')->prefix('incoming')->name('incoming.')->group(function () {
    Route::get('/export_this_month', [IncomingController::class, 'export_this_month'])->name('export_this_month');
    Route::get('/export_this_year', [IncomingController::class, 'export_this_year'])->name('export_this_year');
    Route::get('/data', [IncomingController::class, 'data'])->name('data');
    Route::get('/data/this_year', [IncomingController::class, 'data_this_year'])->name('data.this_year');
    Route::get('/', [IncomingController::class, 'index'])->name('index');
    Route::get('/truncate', [IncomingController::class, 'truncate'])->name('truncate');
    Route::get('/this_year', [IncomingController::class, 'index_this_year'])->name('index_this_year');
    Route::get('/{id}', [IncomingController::class, 'show'])->name('show');
    Route::post('/import_excel', [IncomingController::class, 'import_excel'])->name('import_excel');
});

Route::middleware('auth')->group(function () {
    Route::get('budget/data', [BudgetController::class, 'data'])->name('budget.data');
    Route::resource('budget', BudgetController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('budget_type/data', [BudgetTypeController::class, 'data'])->name('budget_type.data');
    Route::resource('budget_type', BudgetTypeController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('history/data', [HistoryController::class, 'data'])->name('history.data');
    Route::resource('history', HistoryController::class);
});

