<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EncargoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
            'presupuesto' => $this->presupuesto,
            'estado' => $this->estado,
            'fecha_estimada_inicio' => $this->fecha_entregada,
            'fecha_estimada_final' => $this->fecha_entregada1,
            'trabajador_id' => $this->trabajador_id,
            'cliente_id' => $this->cliente_id,
            'trabajador' => TrabajadorResource::make($this->whenLoaded('trabajador'))->only(['user']),
            'cliente' => ClienteResource::make($this->whenLoaded('cliente'))->only(['user']),
            'servicio' => ServicioResource::make($this->whenLoaded('servicio')),
        ];
    }
}
