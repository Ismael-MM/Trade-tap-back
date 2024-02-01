<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});



Route::apiResource('trabajador', App\Http\Controllers\Api\v1\TrabajadorController::class);

Route::apiResource('cliente', App\Http\Controllers\Api\v1\ClienteController::class);

Route::apiResource('horario-trabajador', App\Http\Controllers\Api\v1\HorarioTrabajadorController::class);

Route::apiResource('horario-inhabilitado', App\Http\Controllers\Api\v1\HorarioInhabilitadoController::class);

Route::apiResource('profesion', App\Http\Controllers\Api\v1\ProfesionController::class);

Route::apiResource('solicitud', App\Http\Controllers\Api\v1\SolicitudController::class);
