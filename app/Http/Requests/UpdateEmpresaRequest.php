<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmpresaRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|max:255',
            'propietario' => 'required|max:255',
            'ruc' => 'required|max:50',
            'porcentaje_impuesto' => 'required|numeric',
            'abreviatura_impuesto' => 'required|max:5',
            'direccion' => 'required|max:255',
            'correo' => 'nullable|max:255',
            'telefono' => 'nullable|max:255',
            'ubicacion' => 'nullable|max:255',
            'moneda_id' => 'required|integer|exists:monedas,id'
        ];
    }
}
