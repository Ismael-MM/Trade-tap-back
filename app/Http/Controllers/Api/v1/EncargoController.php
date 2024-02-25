<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\EncargoStoreRequest;
use App\Http\Requests\Api\v1\EncargoUpdateRequest;
use App\Http\Resources\Api\v1\EncargoCollection;
use App\Http\Resources\Api\v1\EncargoResource;
use App\Models\Encargo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EncargoController extends Controller
{
    public function index(Request $request)
    {
        // $user = request()->user();

        // if ($user->rol == "trabajador") {
        //     $encargos = Encargo::where('trabajador_id', $user->userable_id)->get();
        // } else {
        //     $encargos = Encargo::where('cliente_id', $user->userable_id)->get();
        // }

        // $encargos->load(['trabajador', 'cliente']);

        $encargos = Encargo::all();

        $encargos->load(['trabajador', 'cliente']);

        return new EncargoCollection($encargos);
    }

    public function store(EncargoStoreRequest $request)
    {
        $encargo = Encargo::create($request->validated());

        $encargo->load(['trabajador', 'cliente']);

        return new EncargoResource($encargo);
    }

    public function show(Request $request, Encargo $encargo)
    {
        $encargo->load(['trabajador', 'cliente']);

        if (!$encargo) {
            return response()->json(['error' => 'No se encontró ningun encargo'], 404);
        }

        return new EncargoResource($encargo);
    }

    public function update(EncargoUpdateRequest $request, Encargo $encargo)
    {
        $encargo->load(['trabajador', 'cliente']);

        $encargo->update($request->validated());

        return new EncargoResource($encargo);
    }

    public function destroy(Request $request, Encargo $encargo)
    {
        $encargo->delete();

        return response()->noContent();
    }
}
