<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\TrabajadorStoreRequest;
use App\Http\Requests\Api\v1\TrabajadorUpdateRequest;
use App\Http\Resources\Api\v1\TrabajadorCollection;
use App\Http\Resources\Api\v1\TrabajadorResource;
use App\Models\Trabajador;
use Illuminate\Http\Request;

class TrabajadorController extends Controller
{
    public function index(Request $request)
    {

        if (request()->exists('top') && request()->exists('tipo')) {
         // $profesion = Profesion::findOrFail($profesionId);
        $profesionId = request()->input('tipo'); 

        $trabajadors = Trabajador::whereHas('profesions', function($query) use ($profesionId) {
                                    $query->where('id', $profesionId);
                                })
                                ->withCount('valoracions')
                                ->orderByDesc('valoracions_count')
                                ->with(['profesions' => function($query) use ($profesionId) {
                                    $query->where('id', $profesionId);
                                },'user'])
                                ->take(10)
                                ->get();
        }else{
            $trabajadors = Trabajador::all();
        }

        $trabajadors->load(['user','profesions']);

        return new TrabajadorCollection($trabajadors);
    }

    public function store(TrabajadorStoreRequest $request)
    {
        $trabajador = Trabajador::create($request->validated());

        return new TrabajadorResource($trabajador);
    }

    public function show(Request $request, Trabajador $trabajador)
    {
        $trabajador->load(['user','profesions']);

        return new TrabajadorResource($trabajador);
    }

    public function update(TrabajadorUpdateRequest $request, Trabajador $trabajador)
    {
        $trabajador->update($request->validated());

        return new TrabajadorResource($trabajador);
    }

    public function destroy(Request $request, Trabajador $trabajador)
    {
        $trabajador->delete();

        return response()->noContent();
    }
}
