<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\ProfesionController;

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

Route::get('profesion', [ProfesionController::class, 'index']); //Listado de profesiones

Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('profesion', [ProfesionController::class, 'store']);//Crear una nueva profesión con aut
    Route::get('profesion/{profesion}', [ProfesionController::class, 'show']);//Mostrar información de una profesión
    Route::put('profesion/{profesion}', [ProfesionController::class, 'update']);//Modificar información de una profesión
    Route::patch('profesion/{profesion}', [ProfesionController::class, 'update']);//Modificar información de una profesión
    Route::delete('profesion/{profesion}', [ProfesionController::class, 'destroy']);

    Route::apiResource('Usuario', App\Http\Controllers\Api\v1\UserController::class);

    Route::apiResource('trabajador', App\Http\Controllers\Api\v1\TrabajadorController::class);

    Route::apiResource('cliente', App\Http\Controllers\Api\v1\ClienteController::class);

    Route::apiResource('horario-trabajador', App\Http\Controllers\Api\v1\HorarioTrabajadorController::class);

    Route::apiResource('horario-inhabilitado', App\Http\Controllers\Api\v1\HorarioInhabilitadoController::class);

    Route::apiResource('solicitud', App\Http\Controllers\Api\v1\SolicitudController::class);

    Route::apiResource('propuesta', App\Http\Controllers\Api\v1\PropuestaController::class);

    Route::apiResource('encargo', App\Http\Controllers\Api\v1\EncargoController::class);

    Route::apiResource('reserva', App\Http\Controllers\Api\v1\ReservaController::class);

    Route::apiResource('horario-reserva', App\Http\Controllers\Api\v1\HorarioReservaController::class);

    Route::apiResource('servicio', App\Http\Controllers\Api\v1\ServicioController::class);

    Route::apiResource('valoracion', App\Http\Controllers\Api\v1\ValoracionController::class);

    Route::apiResource('publicacion', App\Http\Controllers\Api\v1\PublicacionController::class);

    Route::apiResource('multimedia', App\Http\Controllers\Api\v1\MultimediaController::class);
});
