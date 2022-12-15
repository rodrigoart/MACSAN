<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HojaMonitoreoController;
use App\Http\Controllers\InsumoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MinutaController;
use App\Http\Controllers\ProblemaController;
use App\Http\Controllers\DashboardController;




Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        // 'laravelVersion' => Application::VERSION,
        // 'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum', config('jetstream.auth_session'), 'verified',
])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('hoja-monitoreo', HojaMonitoreoController::class);
    Route::get('hoja-monitoreo-pdf/{hoja_monitoreo}', [HojaMonitoreoController::class, 'print_pdf'])->name('hoja-monitoreo-pdf');
    Route::resource('insumo', InsumoController::class)->except('create');
    Route::resource('minuta', MinutaController::class);
    Route::get('minuta-pdf/{minutum}', [MinutaController::class, 'print_pdf'])->name('minuta-pdf');
    Route::resource('problema', ProblemaController::class)->except('create');
    Route::resource('usuario', UserController::class);

});
