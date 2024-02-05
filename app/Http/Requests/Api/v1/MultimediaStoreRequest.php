<?php

namespace App\Http\Requests\Api\v1;

use Illuminate\Foundation\Http\FormRequest;

class MultimediaStoreRequest extends FormRequest
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
            'tipo' => ['required', 'in:Foto,Video'],
            'url' => ['required', 'string'],
            'valoracion_id' => ['required', 'integer', 'exists:valoracions,id'],
        ];
    }
}
