<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\TrabajadorStoreRequest;
use App\Http\Requests\Api\v1\TrabajadorUpdateRequest;
use App\Http\Resources\Api\v1\TrabajadorCollection;
use App\Http\Resources\Api\v1\TrabajadorResource;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TrabajadorController extends Controller
{
    public function index(Request $request): Response
    {
        $trabajadors = Trabajador::all();

        return new TrabajadorCollection($trabajadors);
    }

    public function store(TrabajadorStoreRequest $request): Response
    {
        $trabajador = Trabajador::create($request->validated());

        return new TrabajadorResource($trabajador);
    }

    public function show(Request $request, Trabajador $trabajador): Response
    {
        return new TrabajadorResource($trabajador);
    }

    public function update(TrabajadorUpdateRequest $request, Trabajador $trabajador): Response
    {
        $trabajador->update($request->validated());

        return new TrabajadorResource($trabajador);
    }

    public function destroy(Request $request, Trabajador $trabajador): Response
    {
        $trabajador->delete();

        return response()->noContent();
    }
}
