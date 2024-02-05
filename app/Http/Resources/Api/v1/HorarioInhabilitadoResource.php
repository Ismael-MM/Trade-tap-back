<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HorarioInhabilitadoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'fecha' => $this->fecha,
            'trabajador_id' => $this->trabajador_id,
            'trabajador' => TrabajadorResource::make($this->whenLoaded('trabajador')),
        ];
    }
}
