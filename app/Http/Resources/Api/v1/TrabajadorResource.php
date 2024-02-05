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
            'cif' => $this->cif,
            'descripcion' => $this->descripcion,
            'situacion' => $this->situacion,
            'users' => UserCollection::make($this->whenLoaded('users')),
            'horarioInhabilitado' => HorarioInhabilitadoResource::make($this->whenLoaded('horarioInhabilitado')),
            'clientes' => ClienteCollection::make($this->whenLoaded('clientes')),
            'publicacions' => PublicacionCollection::make($this->whenLoaded('publicacions')),
        ];
    }
}
