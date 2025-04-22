<?php

namespace App\Http\Requests;

use App\Enums\MetodoPagoEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreVentaRequest extends FormRequest
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
            'cliente_id' => 'required|exists:clientes,id',
            'comprobante_id' => 'required|exists:comprobantes,id',
            'metodo_pago' => ['required', new Enum(MetodoPagoEnum::class)],
            'subtotal' => 'required|min:1',
            'impuesto' => 'required|numeric',
            'total' => 'required|numeric',
            'monto_recibido' => 'required|numeric|min:1',
            'vuelto_entregado' => 'required|numeric|min:0'
        ];
    }
}
