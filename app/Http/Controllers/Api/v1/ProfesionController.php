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
    public function index(Request $request): Response
    {
        $profesions = Profesion::all();

        return new ProfesionCollection($profesions);
    }

    public function store(ProfesionStoreRequest $request): Response
    {
        $profesion = Profesion::create($request->validated());

        return new ProfesionResource($profesion);
    }

    public function show(Request $request, Profesion $profesion): Response
    {
        return new ProfesionResource($profesion);
    }

    public function update(ProfesionUpdateRequest $request, Profesion $profesion): Response
    {
        $profesion->update($request->validated());

        return new ProfesionResource($profesion);
    }

    public function destroy(Request $request, Profesion $profesion): Response
    {
        $profesion->delete();

        return response()->noContent();
    }
}
