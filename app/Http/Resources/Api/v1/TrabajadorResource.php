<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TrabajadorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'descripcion' => $this->descripcion,
            'situacion' => $this->situacion,
            'user' => UserResource::make($this->whenLoaded('user')),
            'horarioInhabilitado' => HorarioInhabilitadoResource::make($this->whenLoaded('horarioInhabilitado')),
            'clientes' => ClienteCollection::make($this->whenLoaded('clientes')),
            'publicacions' => PublicacionCollection::make($this->whenLoaded('publicacions')),
            'valoracion' => $this->whenLoaded('valoracions') ? $this->valoracions->avg('Puntuacion') : null,
        ];
    }
}
