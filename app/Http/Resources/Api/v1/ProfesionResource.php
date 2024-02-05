<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfesionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'familia_profesional' => $this->familia_profesional,
            'trabajadors' => TrabajadorCollection::make($this->whenLoaded('trabajadors')),
        ];
    }
}
