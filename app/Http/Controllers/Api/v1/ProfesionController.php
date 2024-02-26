<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\ProfesionStoreRequest;
use App\Http\Requests\Api\v1\ProfesionUpdateRequest;
use App\Http\Resources\Api\v1\ProfesionCollection;
use App\Http\Resources\Api\v1\ProfesionResource;
use App\Models\Profesion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProfesionController extends Controller
{
    public function index(Request $request)
    {
        // Verificar si se solicita la paginación y obtener el número de página
        if ($request->has('list') && $request->input('list') === 'true' && $request->has('page')) {
            // Obtener el número de página desde la solicitud
            $page = $request->input('page');

            // Obtener las profesiones paginadas con un límite de 6 por página
            $profesions = Profesion::paginate(6, ['*'], 'page', $page);
        } else {
            // Obtener todas las profesiones si no se especificó la paginación
            $profesions = Profesion::all();
        }

        // Retornar una colección de profesiones según la lógica anterior
        return new ProfesionCollection($profesions);
    }


    public function store(ProfesionStoreRequest $request)
    {
        $profesion = Profesion::create($request->validated());

        return new ProfesionResource($profesion);
    }

    public function show(Request $request, Profesion $profesion)
    {
        return new ProfesionResource($profesion);
    }

    public function update(ProfesionUpdateRequest $request, Profesion $profesion)
    {
        $profesion->update($request->validated());

        return new ProfesionResource($profesion);
    }

    public function destroy(Request $request, Profesion $profesion)
    {
        $profesion->delete();

        return response()->noContent();
    }
}
