<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\SolicitudStoreRequest;
use App\Http\Requests\Api\v1\SolicitudUpdateRequest;
use App\Http\Resources\Api\v1\SolicitudCollection;
use App\Http\Resources\Api\v1\SolicitudResource;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SolicitudController extends Controller
{
    public function index(Request $request) 
    {
        // $solicituds = Solicitud::all();

        $user = request()->user();

        if ($user->rol == 'trabajador') {
            $solicituds = Solicitud::where('trabajador_id', $user->userable_id)->get();
        }else {
            $solicituds = Solicitud::where('cliente_id', $user->userable_id)->get();
        }

        $solicituds->load(['trabajador', 'cliente']);

        return new SolicitudCollection($solicituds);
    }

    public function store(SolicitudStoreRequest $request)
    {
        $solicitud = Solicitud::create($request->validated());

        $solicitud->load(['trabajador', 'cliente']);

        return new SolicitudResource($solicitud);
    }

    public function show(Request $request, Solicitud $solicitud)
    {
        $solicitud->load(['trabajador', 'cliente']);

        return new SolicitudResource($solicitud);
    }

    public function update(SolicitudUpdateRequest $request, Solicitud $solicitud)
    {
        $solicitud->update($request->validated());

        return new SolicitudResource($solicitud);
    }

    public function destroy(Request $request, Solicitud $solicitud)
    {
        $solicitud->delete();

        return response()->noContent();
    }
}
