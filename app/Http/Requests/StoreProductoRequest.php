<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoRequest extends FormRequest
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
            'codigo' => 'nullable|unique:productos,codigo|max:50',
            'nombre' => 'required|unique:productos,nombre|max:255',
            'descripcion' => 'nullable|max:255',
            'img_path' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'marca_id' => 'nullable|integer|exists:marcas,id',
            'presentacione_id' => 'required|integer|exists:presentaciones,id',
            'categoria_id' => 'nullable|integer|exists:categorias,id'
        ];
    }

    public function attributes()
    {
        return [
            'marca_id' => 'marca',
            'presentacione_id' => 'presentación',
            'categoria_id' => 'categoría'
        ];
    }

    public function messages()
    {
        return [
           // 'codigo.required' => 'Se necesita un campo código'
        ];
    }
}
