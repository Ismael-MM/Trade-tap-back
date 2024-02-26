<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservaResource extends JsonResource
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
            'estado' => $this->estado,
            'presupuesto' => $this->presupuesto,
            'trabajador_id' => $this->trabajador_id,
            'cliente_id' => $this->cliente_id,
            'cliente' => ClienteResource::make($this->whenLoaded('cliente'))->only(['user']),
            'trabajador' => TrabajadorResource::make($this->whenLoaded('trabajador'))->only(['user']),
            'horarioReservas' => HorarioReservaCollection::make($this->whenLoaded('horarioReservas')),
        ];
    }
}
