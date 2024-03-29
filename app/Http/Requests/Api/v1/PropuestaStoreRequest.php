<?php

namespace App\Http\Requests\Api\v1;

use Illuminate\Foundation\Http\FormRequest;

class PropuestaStoreRequest extends FormRequest
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
            'cliente_id' => ['required', 'integer', 'exists:Clientes,id'],
            'trabajador_id' => ['required', 'integer', 'exists:Trabajadors,id'],
            'fecha_estimada_inicio' => ['required', 'date'],
            'fecha_estimada_final' => ['required', 'date'],
            'tipo' => ['required', 'in:encargo,reserva'],
            'presupuesto' => ['required'],
            'estado' => ['required', 'in:Aceptado,Pendiente,Rechazado'],
        ];
    }
}
