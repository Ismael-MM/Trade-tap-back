<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClienteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'trabajadors' => TrabajadorCollection::make($this->whenLoaded('trabajadors')),
            'users' => UserCollection::make($this->whenLoaded('users')),
            'valoracions' => ValoracionCollection::make($this->whenLoaded('valoracions')),
        ];
    }
}
