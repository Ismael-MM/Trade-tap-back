<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'nombre' => $this->name,
            'email' => $this->email,
            'apellido1' => $this->apellido1,
            'apellido2' => $this->apellido2,
            'usuario' => $this->usuario,
            'rol' => $this->rol,
            'localidad' => $this->localidad,
            'provincia' => $this->provincia,
        ];
    }
}
