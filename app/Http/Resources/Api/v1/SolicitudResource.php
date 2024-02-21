<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SolicitudResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'descripcion' => $this->descripcion,
            'titulo' => $this->titulo,
            'estado' => $this->estado,
            'trabajador' => TrabajadorResource::make($this->whenLoaded('trabajador'))->only(['user']),
            'cliente_id' => $this->cliente_id,
            'cliente' => ClienteResource::make($this->whenLoaded('cliente')),
        ];
    }
}
