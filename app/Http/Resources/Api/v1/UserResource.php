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
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'apellido1' => $this->apellido1,
            'apellido2' => $this->apellido2,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
            'cp' => $this->cp,
            'usuario' => $this->usuario,
            'localidad' => $this->localidad,
            'provincia' => $this->provincia,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
