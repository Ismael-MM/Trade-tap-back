<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\ClienteStoreRequest;
use App\Http\Requests\Api\v1\ClienteUpdateRequest;
use App\Http\Resources\Api\v1\ClienteCollection;
use App\Http\Resources\Api\v1\ClienteResource;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClienteController extends Controller
{
    public function index(Request $request): Response
    {
        $clientes = Cliente::all();

        return new ClienteCollection($clientes);
    }

    public function store(ClienteStoreRequest $request): Response
    {
        $cliente = Cliente::create($request->validated());

        return new ClienteResource($cliente);
    }

    public function show(Request $request, Cliente $cliente): Response
    {
        return new ClienteResource($cliente);
    }

    public function update(ClienteUpdateRequest $request, Cliente $cliente): Response
    {
        $cliente->update($request->validated());

        return new ClienteResource($cliente);
    }

    public function destroy(Request $request, Cliente $cliente): Response
    {
        $cliente->delete();

        return response()->noContent();
    }
}
