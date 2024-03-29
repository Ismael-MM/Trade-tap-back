<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\SolicitudStoreRequest;
use App\Http\Requests\Api\v1\SolicitudUpdateRequest;
use App\Http\Resources\Api\v1\SolicitudCollection;
use App\Http\Resources\Api\v1\SolicitudResource;
use App\Mail\SolicitudCreada;
use App\Mail\SolicitudEstadoCambiado;
use App\Mail\SolicitudNueva;
use App\Mail\SolicitudRechazada;
use App\Models\Solicitud;
use Illuminate\Support\Facades\Mail;
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
        } else if ($user->rol == 'cliente') {
            $solicituds = Solicitud::where('cliente_id', $user->userable_id)->get();
        } else {
            return response()->json(['status' => 'No hay elementos en la base de datos'], 204);
        }

        $solicituds->load(['trabajador', 'cliente']);

        return new SolicitudCollection($solicituds);
    }

    public function store(SolicitudStoreRequest $request)
    {

        $solicitud = Solicitud::create($request->validated());

        $user = request()->user();
        $trabajador = $solicitud->trabajador->user;

        Mail::to($user->email)->send(new SolicitudCreada($solicitud));
        Mail::to($trabajador->email)->send(new SolicitudNueva($solicitud));

        $solicitud->load(['trabajador', 'cliente']);

        return new SolicitudResource($solicitud);
    }

    public function show(Request $request, Solicitud $solicitud)
    {
        $solicitud->load(['trabajador', 'cliente']);

        if (!$solicitud) {
            return response()->json(['error' => 'No se encontró ninguna solicitud'], 404);
        }

        return new SolicitudResource($solicitud);
    }

    public function update(SolicitudUpdateRequest $request, Solicitud $solicitud)
    {

        $user = $solicitud->cliente->user;

        $solicitud->load(['trabajador', 'cliente']);

        $solicitud->update($request->validated());

        if ($request->has('estado')) {
            Mail::to($user->email)->send(new SolicitudEstadoCambiado($solicitud));
        }

        return new SolicitudResource($solicitud);
    }

    public function destroy(Request $request, Solicitud $solicitud)
    {
        $user = $solicitud->cliente->user;
        
        Mail::to($user->email)->send(new SolicitudRechazada($solicitud));

        $solicitud->delete();

        return response()->noContent();
    }
}
