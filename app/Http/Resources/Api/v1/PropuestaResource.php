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
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'cliente_id' => $this->cliente_id,
            'trabajador_id' => $this->trabajador_id,
            'cliente' => ClienteResource::make($this->whenLoaded('cliente')),
        ];
    }
}