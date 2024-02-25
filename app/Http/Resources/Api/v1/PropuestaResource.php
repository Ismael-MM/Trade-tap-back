<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropuestaResource extends JsonResource
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
            'fecha_estimada_inicio' => $this->fecha_estimada_inicio,
            'fecha_estimada_final' => $this->fecha_estimada_final,
            'tipo' => $this->tipo,
            'estado' => $this->estado,
            'cliente_id' => $this->cliente_id,
            'trabajador_id' => $this->trabajador_id,
            'trabajador' => TrabajadorResource::make($this->whenLoaded('trabajador'))->only(['user']),
            'cliente' => ClienteResource::make($this->whenLoaded('cliente'))->only(['user']),
        ];
    }
}
