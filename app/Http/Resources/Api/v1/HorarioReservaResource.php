<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HorarioReservaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'fecha' => $this->fecha,
            'hora_comienzo' => $this->hora_comienzo,
            'hora_final' => $this->hora_final,
            'reserva_id' => $this->reserva_id,
            'reserva' => ReservaResource::make($this->whenLoaded('reserva')),
        ];
    }
}
