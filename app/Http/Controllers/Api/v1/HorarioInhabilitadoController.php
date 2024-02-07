<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\HorarioInhabilitadoStoreRequest;
use App\Http\Requests\Api\v1\HorarioInhabilitadoUpdateRequest;
use App\Http\Resources\Api\v1\HorarioInhabilitadoCollection;
use App\Http\Resources\Api\v1\HorarioInhabilitadoResource;
use App\Models\HorarioInhabilitado;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HorarioInhabilitadoController extends Controller
{
    public function index(Request $request)
    {
        $horarioInhabilitados = HorarioInhabilitado::all();

        return new HorarioInhabilitadoCollection($horarioInhabilitados);
    }

    public function store(HorarioInhabilitadoStoreRequest $request)
    {
        $horarioInhabilitado = HorarioInhabilitado::create($request->validated());

        return new HorarioInhabilitadoResource($horarioInhabilitado);
    }

    public function show(Request $request, HorarioInhabilitado $horarioInhabilitado)
    {
        return new HorarioInhabilitadoResource($horarioInhabilitado);
    }

    public function update(HorarioInhabilitadoUpdateRequest $request, HorarioInhabilitado $horarioInhabilitado)
    {
        $horarioInhabilitado->update($request->validated());

        return new HorarioInhabilitadoResource($horarioInhabilitado);
    }

    public function destroy(Request $request, HorarioInhabilitado $horarioInhabilitado)
    {
        $horarioInhabilitado->delete();

        return response()->noContent();
    }
}
