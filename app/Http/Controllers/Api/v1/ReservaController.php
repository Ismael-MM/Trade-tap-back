<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\ReservaStoreRequest;
use App\Http\Requests\Api\v1\ReservaUpdateRequest;
use App\Http\Resources\Api\v1\ReservaCollection;
use App\Http\Resources\Api\v1\ReservaResource;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReservaController extends Controller
{
    public function index(Request $request)
    {
        $reservas = Reserva::all();

        return new ReservaCollection($reservas);
    }

    public function store(ReservaStoreRequest $request)
    {
        $reserva = Reserva::create($request->validated());

        return new ReservaResource($reserva);
    }

    public function show(Request $request, Reserva $reserva)
    {
        return new ReservaResource($reserva);
    }

    public function update(ReservaUpdateRequest $request, Reserva $reserva)
    {
        $reserva->update($request->validated());

        return new ReservaResource($reserva);
    }

    public function destroy(Request $request, Reserva $reserva)
    {
        $reserva->delete();

        return response()->noContent();
    }
}
