<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServicioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'encargo_id' => $this->encargo_id,
            'reserva_id' => $this->reserva_id,
            'reserva' => ReservaResource::make($this->whenLoaded('reserva')),
            'valoracion' => ValoracionResource::make($this->whenLoaded('valoracion')),
        ];
    }
}
