<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ValoracionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'Puntuacion' => $this->Puntuacion,
            'cliente_id' => $this->cliente_id,
            'trabajador_id' => $this->trabajador_id,
            'serivicio_id' => $this->serivicio_id,
            'servicio_id' => $this->servicio_id,
            'servicio' => ServicioResource::make($this->whenLoaded('servicio')),
            'multimedia' => MultimediaCollection::make($this->whenLoaded('multimedia')),
        ];
    }
}
