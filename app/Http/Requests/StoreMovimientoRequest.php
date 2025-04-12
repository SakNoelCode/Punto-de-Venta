<?php

namespace App\Http\Requests;

use App\Enums\MetodoPagoEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreMovimientoRequest extends FormRequest
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
            'descripcion' => 'required|max:255',
            'monto' => 'numeric|min:1|required',
            'metodo_pago' => ['required', new Enum(MetodoPagoEnum::class)],
            'caja_id' => 'required',
            'tipo' => 'required'
        ];
    }
}
