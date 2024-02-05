<?php

namespace App\Http\Requests\Api\v1;

use Illuminate\Foundation\Http\FormRequest;

class ValoracionStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'Puntuacion' => ['required', 'numeric'],
            'cliente_id' => ['required', 'integer', 'exists:Clientes,id'],
            'trabajador_id' => ['required', 'integer', 'exists:Trabajadors,id'],
            'serivicio_id' => ['required', 'integer', 'gt:0'],
            'servicio_id' => ['required', 'integer', 'exists:servicios,id'],
        ];
    }
}
