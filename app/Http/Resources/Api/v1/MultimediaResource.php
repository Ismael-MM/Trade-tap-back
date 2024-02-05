<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MultimediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'tipo' => $this->tipo,
            'url' => $this->url,
            'valoracion_id' => $this->valoracion_id,
            'valoracion' => ValoracionResource::make($this->whenLoaded('valoracion')),
        ];
    }
}
