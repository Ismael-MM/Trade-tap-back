<?php

namespace App\Http\Requests\Api\v1;

use Illuminate\Foundation\Http\FormRequest;

class ReservaStoreRequest extends FormRequest
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
            'presupuesto' => ['required'],
            'estado' => ['required', 'in:Finalizada,Pendiente,En'],
            'trabajador_id' => ['required', 'integer', 'exists:trabajadors,id'],
            'cliente_id' => ['required', 'integer', 'exists:clientes,id'],
        ];
    }
}
