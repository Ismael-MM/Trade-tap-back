<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\ValoracionStoreRequest;
use App\Http\Requests\Api\v1\ValoracionUpdateRequest;
use App\Http\Resources\Api\v1\ValoracionCollection;
use App\Http\Resources\Api\v1\ValoracionResource;
use App\Models\Valoracion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ValoracionController extends Controller
{
    public function index(Request $request): Response
    {
        $valoracions = Valoracion::all();

        return new ValoracionCollection($valoracions);
    }

    public function store(ValoracionStoreRequest $request): Response
    {
        $valoracion = Valoracion::create($request->validated());

        return new ValoracionResource($valoracion);
    }

    public function show(Request $request, Valoracion $valoracion): Response
    {
        return new ValoracionResource($valoracion);
    }

    public function update(ValoracionUpdateRequest $request, Valoracion $valoracion): Response
    {
        $valoracion->update($request->validated());

        return new ValoracionResource($valoracion);
    }

    public function destroy(Request $request, Valoracion $valoracion): Response
    {
        $valoracion->delete();

        return response()->noContent();
    }
}