<?php

use App\Http\Controllers\GrpoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncomingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MigiController;
use App\Http\Controllers\PowithetaController;
use App\Http\Controllers\RegisterController;
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

