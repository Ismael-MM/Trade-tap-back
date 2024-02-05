<?php

namespace App\Http\Requests\Api\v1;

use Illuminate\Foundation\Http\FormRequest;

class SolicitudUpdateRequest extends FormRequest
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
            'descripcion' => ['required', 'string'],
            'titulo' => ['required', 'string'],
            'estado' => ['required', 'in:Aceptado,Pendiente,Rechazado'],
            'trabajador_id' => ['required', 'integer', 'exists:trabajadors,id'],
            'cliente_id' => ['required', 'integer', 'exists:clientes,id'],
        ];
    }
}
