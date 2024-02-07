<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\HorarioTrabajadorStoreRequest;
use App\Http\Requests\Api\v1\HorarioTrabajadorUpdateRequest;
use App\Http\Resources\Api\v1\HorarioTrabajadorCollection;
use App\Http\Resources\Api\v1\HorarioTrabajadorResource;
use App\Models\HorarioTrabajador;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HorarioTrabajadorController extends Controller
{
    public function index(Request $request)
    {
        $horarioTrabajadors = HorarioTrabajador::all();

        return new HorarioTrabajadorCollection($horarioTrabajadors);
    }

    public function store(HorarioTrabajadorStoreRequest $request)
    {
        $horarioTrabajador = HorarioTrabajador::create($request->validated());

        return new HorarioTrabajadorResource($horarioTrabajador);
    }

    public function show(Request $request, HorarioTrabajador $horarioTrabajador)
    {
        return new HorarioTrabajadorResource($horarioTrabajador);
    }

    public function update(HorarioTrabajadorUpdateRequest $request, HorarioTrabajador $horarioTrabajador)
    {
        $horarioTrabajador->update($request->validated());

        return new HorarioTrabajadorResource($horarioTrabajador);
    }

    public function destroy(Request $request, HorarioTrabajador $horarioTrabajador)
    {
        $horarioTrabajador->delete();

        return response()->noContent();
    }
}
