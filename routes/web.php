<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\Api\PacienteController;
use App\Http\Controllers\Api\DiagnosticoController;
use App\Http\Controllers\Api\OperacionController;
use App\Http\Controllers\Api\MedicoController;
use App\Http\Controllers\EjecucionCirugiaController;
use App\Http\Controllers\ReporteController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('solicitudes', SolicitudController::class);
    Route::get('/api/paciente-por-historia', [PacienteController::class, 'porHistoria'])
        ->name('api.paciente.por_historia');
    Route::get('/api/diagnostico-por-cie10', [DiagnosticoController::class, 'porCie10'])
        ->name('api.diagnostico.por_cie10');
    Route::get('/api/operacion-por-cpt', [OperacionController::class, 'porCpt'])
        ->name('api.operacion.por_cpt');
    Route::get('/api/medicos/buscar', [MedicoController::class, 'buscar'])
        ->name('api.medicos.buscar');
    Route::get('/solicitudes/{id}/culminar', [SolicitudController::class, 'culminar'])
        ->name('solicitudes.culminar');

    Route::put('/solicitudes/{id}/culminar', [SolicitudController::class, 'guardarCulminacion'])
        ->name('solicitudes.guardarCulminacion');

    Route::get('/cirugias', [App\Http\Controllers\CirugiaController::class, 'index'])
        ->name('cirugias.index');
    Route::get('/cirugias/panel-tv', [App\Http\Controllers\CirugiaController::class, 'panelTv'])
        ->name('cirugias.panel_tv');
    Route::get('/ejecucion-cirugias', [EjecucionCirugiaController::class, 'index'])
        ->name('ejecucion-cirugias.index');
    Route::get('/cirugias/salas', [App\Http\Controllers\CirugiaController::class, 'salas'])
        ->name('cirugias.salas');

    Route::put('/ejecucion-cirugias/{id}/iniciar', [EjecucionCirugiaController::class, 'iniciar'])
        ->name('ejecucion-cirugias.iniciar');

    Route::put('/ejecucion-cirugias/{id}/culminar', [EjecucionCirugiaController::class, 'culminar'])
        ->name('ejecucion-cirugias.culminar');
    Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
    Route::get('/reportes/exportar/excel', [ReporteController::class, 'exportarExcel'])->name('reportes.exportar.excel');
    Route::get('/reportes/exportar/pdf', [ReporteController::class, 'exportarPdf'])->name('reportes.exportar.pdf');
});
