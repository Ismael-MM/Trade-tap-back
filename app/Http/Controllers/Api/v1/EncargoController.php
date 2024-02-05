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
    public function index(Request $request): Response
    {
        $encargos = Encargo::all();

        return new EncargoCollection($encargos);
    }

    public function store(EncargoStoreRequest $request): Response
    {
        $encargo = Encargo::create($request->validated());

        return new EncargoResource($encargo);
    }

    public function show(Request $request, Encargo $encargo): Response
    {
        return new EncargoResource($encargo);
    }

    public function update(EncargoUpdateRequest $request, Encargo $encargo): Response
    {
        $encargo->update($request->validated());

        return new EncargoResource($encargo);
    }

    public function destroy(Request $request, Encargo $encargo): Response
    {
        $encargo->delete();

        return response()->noContent();
    }
}
