<?php

namespace App\Rules;

use App\Models\Caja;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class CajaCerradaRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //Realizar comprobación de que el usuario no tenga ninguna caja aperturada
        if (Caja::where('user_id', Auth::id())->where('estado', 1)->exists()) {
            $fail('Ya tiene una caja aperturada');
        }
    }
}
