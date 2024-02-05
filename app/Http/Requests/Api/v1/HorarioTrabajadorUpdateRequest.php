<?php

namespace App\Http\Requests\Api\v1;

use Illuminate\Foundation\Http\FormRequest;

class HorarioTrabajadorUpdateRequest extends FormRequest
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
            'rango' => ['required', 'in:Lunes-Viernes,Lunes-Sabado,Lunes-Domingo'],
            'hora_comienzo' => ['required'],
            'hora_final' => ['required'],
            'trabajador_id' => ['required', 'integer', 'exists:Trabajadors,id'],
        ];
    }
}
