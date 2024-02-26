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
            'coste' => $this->coste,
            'tipo_servicio' => $this->whenLoaded('serviciable', function () {
                if ($this->servicioable_type === 'App\Models\Encargo') {
                    return new EncargoResource($this->serviciable);
                } elseif ($this->servicioable_type === 'App\Models\Reserva') {
                    return new ReservaResource($this->serviciable);
                }
            }),
            'valoracion' => ValoracionResource::make($this->whenLoaded('valoracion')),
        ];
    }
}
