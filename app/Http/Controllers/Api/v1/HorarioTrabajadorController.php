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
    public function index(Request $request): Response
    {
        $horarioTrabajadors = HorarioTrabajador::all();

        return new HorarioTrabajadorCollection($horarioTrabajadors);
    }

    public function store(HorarioTrabajadorStoreRequest $request): Response
    {
        $horarioTrabajador = HorarioTrabajador::create($request->validated());

        return new HorarioTrabajadorResource($horarioTrabajador);
    }

    public function show(Request $request, HorarioTrabajador $horarioTrabajador): Response
    {
        return new HorarioTrabajadorResource($horarioTrabajador);
    }

    public function update(HorarioTrabajadorUpdateRequest $request, HorarioTrabajador $horarioTrabajador): Response
    {
        $horarioTrabajador->update($request->validated());

        return new HorarioTrabajadorResource($horarioTrabajador);
    }

    public function destroy(Request $request, HorarioTrabajador $horarioTrabajador): Response
    {
        $horarioTrabajador->delete();

        return response()->noContent();
    }
}
