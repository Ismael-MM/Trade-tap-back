<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\PropuestaStoreRequest;
use App\Http\Requests\Api\v1\PropuestaUpdateRequest;
use App\Http\Resources\Api\v1\PropuestaCollection;
use App\Http\Resources\Api\v1\PropuestaResource;
use App\Models\Propuesta;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PropuestaController extends Controller
{
    public function index(Request $request)
    {
        $propuesta = Propuesta::where('cliente_id', auth()->id())->get();

        $propuesta->load(['trabajador', 'cliente']);

        return new PropuestaCollection($propuesta);
    }

    public function store(PropuestaStoreRequest $request)
    {
        $propuestum = Propuesta::create($request->validated());

        return new PropuestaResource($propuestum);
    }

    public function show(Request $request, Propuesta $propuestum)
    {
        return new PropuestaResource($propuestum);
    }

    public function update(PropuestaUpdateRequest $request, Propuesta $propuestum)
    {
        $propuestum->update($request->validated());

        return new PropuestaResource($propuestum);
    }

    public function destroy(Request $request, Propuesta $propuestum)
    {
        $propuestum->delete();

        return response()->noContent();
    }
}
