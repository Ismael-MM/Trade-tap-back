<?php

namespace App\Http\Requests\Api\v1;

use Illuminate\Foundation\Http\FormRequest;

class PropuestumStoreRequest extends FormRequest
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
            'nombre' => ['required', 'string'],
            'descripcion' => ['required', 'string'],
            'cliente_id' => ['required', 'integer', 'exists:Clientes,id'],
            'trabajador_id' => ['required', 'integer', 'exists:Trabajadors,id'],
        ];
    }
}
