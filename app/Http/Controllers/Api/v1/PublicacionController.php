<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\PublicacionStoreRequest;
use App\Http\Requests\Api\v1\PublicacionUpdateRequest;
use App\Http\Resources\Api\v1\PublicacionCollection;
use App\Http\Resources\Api\v1\PublicacionResource;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PublicacionController extends Controller
{
    public function index(Request $request)
    {
        $publicacions = Publicacion::all();

        return new PublicacionCollection($publicacions);
    }

    public function store(PublicacionStoreRequest $request)
    {
        $publicacion = Publicacion::create($request->validated());

        return new PublicacionResource($publicacion);
    }

    public function show(Request $request, Publicacion $publicacion)
    {
        return new PublicacionResource($publicacion);
    }

    public function update(PublicacionUpdateRequest $request, Publicacion $publicacion)
    {
        $publicacion->update($request->validated());

        return new PublicacionResource($publicacion);
    }

    public function destroy(Request $request, Publicacion $publicacion)
    {
        $publicacion->delete();

        return response()->noContent();
    }
}
