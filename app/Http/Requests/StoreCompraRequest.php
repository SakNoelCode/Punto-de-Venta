<?php

namespace App\Http\Requests;

use App\Enums\MetodoPagoEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreCompraRequest extends FormRequest
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
            'proveedore_id' => 'required|exists:proveedores,id',
            'comprobante_id' => 'required|exists:comprobantes,id',
            'numero_comprobante' => 'max:255|nullable',
            'file_comprobante' => 'nullable|file|mimes:pdf|max:2048',
            'metodo_pago' => ['required', new Enum(MetodoPagoEnum::class)],
            'fecha_hora' => 'required|date|date_format:Y-m-d\TH:i',
            'subtotal' => 'required|min:1',
            'impuesto' => 'required|min:0',
            'total' => 'required|min:1'
        ];
    }
}
