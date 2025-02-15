<?php

namespace App\Enums;

enum TipoTransaccionEnum: string
{
    case Compra = 'COMPRA';
    case Venta = 'VENTA';
    case Ajuste = 'AJUSTE';
    case Apertura = 'APERTURA';
}
