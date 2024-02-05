<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\HorarioReservaStoreRequest;
use App\Http\Requests\Api\v1\HorarioReservaUpdateRequest;
use App\Http\Resources\Api\v1\HorarioReservaCollection;
use App\Http\Resources\Api\v1\HorarioReservaResource;
use App\Models\HorarioReserva;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HorarioReservaController extends Controller
{
    public function index(Request $request): Response
    {
        $horarioReservas = HorarioReserva::all();

        return new HorarioReservaCollection($horarioReservas);
    }

    public function store(HorarioReservaStoreRequest $request): Response
    {
        $horarioReserva = HorarioReserva::create($request->validated());

        return new HorarioReservaResource($horarioReserva);
    }

    public function show(Request $request, HorarioReserva $horarioReserva): Response
    {
        return new HorarioReservaResource($horarioReserva);
    }

    public function update(HorarioReservaUpdateRequest $request, HorarioReserva $horarioReserva): Response
    {
        $horarioReserva->update($request->validated());

        return new HorarioReservaResource($horarioReserva);
    }

    public function destroy(Request $request, HorarioReserva $horarioReserva): Response
    {
        $horarioReserva->delete();

        return response()->noContent();
    }
}
