<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PublicacionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'url' => $this->url,
            'trabajador_id' => $this->trabajador_id,
            'trabajador' => TrabajadorResource::make($this->whenLoaded('trabajador')),
        ];
    }
}
