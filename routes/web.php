<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Models\Ciudad;
use App\Http\Controllers\ExportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| 
|
*/
Route::get('/', function () {
    return view('welcome');
});

// Routes for the survey
// We made de CRUD operations for the survey , is not a real CRUD, just the basic operations
Route::get('/encuesta', [ClienteController::class, 'index'])->name('encuesta');
Route::post('/encuesta/store', [ClienteController::class, 'store'])->name('encuesta.store');
Route::get('/encuestas', [ClienteController::class, 'show'])->name('encuesta.show');
// Route to  select a department and get the cities from backend
Route::get('/ciudades/{departamento_id}', function ($departamento_id) {
    $ciudades = Ciudad::where('departamento_id', $departamento_id)->get(['id', 'nombre']);
    return response()->json($ciudades);
});

// Route to select a  winner
Route::post('/seleccionar-ganador', [ClienteController::class, 'seleccionarGanador'])->name('seleccionar.ganador');
// Route to get the data excel from backend logic
Route::get('/exportar-clientes', [ExportController::class, 'exportarClientes'])->name('export.excel');