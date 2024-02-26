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
    public function index(Request $request)
    {
        $user = $request->user();
        $pageSize = 3;

        if ($user->rol == "trabajador") {
            $valoracions = Valoracion::where('trabajador_id', $user->userable_id)->paginate($pageSize);
        } else {
            $valoracions = Valoracion::where('cliente_id', $user->userable_id)->paginate($pageSize);
        }

        $valoracions->load(['trabajador', 'cliente']);

        return new ValoracionCollection($valoracions);
    }

    public function store(ValoracionStoreRequest $request)
    {
        $valoracion = Valoracion::create($request->validated());

        return new ValoracionResource($valoracion);
    }

    public function show(Request $request, Valoracion $valoracion)
    {
        return new ValoracionResource($valoracion);
    }

    public function update(ValoracionUpdateRequest $request, Valoracion $valoracion)
    {
        $valoracion->update($request->validated());

        return new ValoracionResource($valoracion);
    }

    public function destroy(Request $request, Valoracion $valoracion)
    {
        $valoracion->delete();

        return response()->noContent();
    }
}
