<?php

namespace App\Http\Requests\Api\v1;

use Illuminate\Foundation\Http\FormRequest;

class EncargoUpdateRequest extends FormRequest
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
            'estado' => ['required', 'in:Entregado,Pendiente,Cancelado'],
            'fecha_entregada' => ['required', 'date'],
            'fecha_entregada1' => ['required', 'date'],
            'trabajador_id' => ['required', 'integer', 'exists:trabajadors,id'],
            'cliente_id' => ['required', 'integer', 'exists:clientes,id'],
        ];
    }
}
