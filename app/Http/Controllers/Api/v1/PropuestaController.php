<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\PropuestaStoreRequest;
use App\Http\Requests\Api\v1\PropuestaUpdateRequest;
use App\Http\Resources\Api\v1\PropuestumCollection;
use App\Http\Resources\Api\v1\PropuestumResource;
use App\Models\Propuesta;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PropuestaController extends Controller
{
    public function index(Request $request): Response
    {
        $propuesta = Propuestum::all();

        return new PropuestumCollection($propuesta);
    }

    public function store(PropuestaStoreRequest $request): Response
    {
        $propuestum = Propuestum::create($request->validated());

        return new PropuestumResource($propuestum);
    }

    public function show(Request $request, Propuestum $propuestum): Response
    {
        return new PropuestumResource($propuestum);
    }

    public function update(PropuestaUpdateRequest $request, Propuestum $propuestum): Response
    {
        $propuestum->update($request->validated());

        return new PropuestumResource($propuestum);
    }

    public function destroy(Request $request, Propuestum $propuestum): Response
    {
        $propuestum->delete();

        return response()->noContent();
    }
}
