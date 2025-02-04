<?php

namespace App\Http\Requests;

use App\Enums\TipoPersonaEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StorePersonaRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'razon_social' => 'required|max:255',
            'direccion' => 'nullable|max:255',
            'telefono' => 'nullable|max:15',
            'tipo' => ['required', new Enum(TipoPersonaEnum::class)],
            'email' => 'nullable|max:255|email',
            'documento_id' => 'required|integer|exists:documentos,id',
            'numero_documento' => 'required|max:20|unique:personas,numero_documento'
        ];
    }
}
