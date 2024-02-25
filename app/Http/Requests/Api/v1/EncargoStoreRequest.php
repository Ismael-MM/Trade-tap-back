<?php

namespace App\Http\Requests\Api\v1;

use Illuminate\Foundation\Http\FormRequest;

class EncargoStoreRequest extends FormRequest
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
            'titulo' => ['required', 'string'],
            'descripcion' => ['required', 'string'],
            'estado' => ['required', 'in:Entregado,Pendiente,Cancelado'],
            'fecha_estimada_inicio' => ['required', 'date'],
            'fecha_estimada_final' => ['required', 'date'],
            'trabajador_id' => ['required', 'integer', 'exists:trabajadors,id'],
            'cliente_id' => ['required', 'integer', 'exists:clientes,id'],
        ];
    }
}
