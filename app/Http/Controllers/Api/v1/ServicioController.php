<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\ServicioStoreRequest;
use App\Http\Requests\Api\v1\ServicioUpdateRequest;
use App\Http\Resources\Api\v1\ServicioCollection;
use App\Http\Resources\Api\v1\ServicioResource;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ServicioController extends Controller
{
    public function index(Request $request): Response
    {
        $servicios = Servicio::all();

        return new ServicioCollection($servicios);
    }

    public function store(ServicioStoreRequest $request): Response
    {
        $servicio = Servicio::create($request->validated());

        return new ServicioResource($servicio);
    }

    public function show(Request $request, Servicio $servicio): Response
    {
        return new ServicioResource($servicio);
    }

    public function update(ServicioUpdateRequest $request, Servicio $servicio): Response
    {
        $servicio->update($request->validated());

        return new ServicioResource($servicio);
    }

    public function destroy(Request $request, Servicio $servicio): Response
    {
        $servicio->delete();

        return response()->noContent();
    }
}
