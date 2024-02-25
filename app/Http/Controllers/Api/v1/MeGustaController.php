<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Http\Response;

class MeGustaController extends Controller
{
    public function store(Request $request)
    {
        $user = request()->user();

        $cliente = Cliente::where('cliente_id', $user->userable_id)->get();

        $cliente->roles()->attach(request()->trabajador_id);

        return response()->json(['message' => 'Me gusta registrado.'], Response::HTTP_OK);
    }
}
