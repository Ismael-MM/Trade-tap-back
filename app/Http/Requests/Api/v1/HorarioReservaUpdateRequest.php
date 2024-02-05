<?php

namespace App\Http\Requests\Api\v1;

use Illuminate\Foundation\Http\FormRequest;

class HorarioReservaUpdateRequest extends FormRequest
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
            'fecha' => ['required', 'date'],
            'hora_comienzo' => ['required'],
            'hora_final' => ['required'],
            'reserva_id' => ['required', 'integer', 'exists:reservas,id'],
        ];
    }
}
