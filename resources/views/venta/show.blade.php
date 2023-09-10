@extends('layouts.app')

@section('title','Ver venta')

@push('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<style>
    @media (max-width:575px) {
        #hide-group {
            display: none;
        }
    }

    @media (min-width:576px) {
        #icon-form {
            display: none;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Ver Venta</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('ventas.index')}}">Ventas</a></li>
        <li class="breadcrumb-item active">Ver Venta</li>
    </ol>
</div>

<div class="container-fluid">

    <div class="card mb-4">

        <div class="card-header">
            Datos generales de la venta
        </div>

        <div class="card-body">

            <!---Tipo comprobante--->
            <div class="row mb-4">
                <div class="col-sm-6">
                    <div class="input-group" id="hide-group">
                        <span class="input-group-text"><i class="fa-solid fa-file"></i></span>
                        <input disabled type="text" class="form-control" value="Tipo de comprobante: ">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="input-group">
                        <span title="Tipo de comprobante" id="icon-form" class="input-group-text"><i class="fa-solid fa-file"></i></span>
                        <input disabled type="text" class="form-control" value="{{$venta->comprobante->tipo_comprobante}}">
                    </div>
                </div>
            </div>

            <!---Numero comprobante--->
            <div class="row mb-4">
                <div class="col-sm-6">
                    <div class="input-group" id="hide-group">
                        <span class="input-group-text"><i class="fa-solid fa-hashtag"></i></span>
                        <input disabled type="text" class="form-control" value="Número de comprobante: ">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="input-group">
                        <span title="Número de comprobante" id="icon-form" class="input-group-text"><i class="fa-solid fa-hashtag"></i></span>
                        <input disabled type="text" class="form-control" value="{{$venta->numero_comprobante}}">
                    </div>
                </div>
            </div>

            <!---Cliente--->
            <div class="row mb-4">
                <div class="col-sm-6">
                    <div class="input-group" id="hide-group">
                        <span class="input-group-text"><i class="fa-solid fa-user-tie"></i></span>
                        <input disabled type="text" class="form-control" value="Cliente: ">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="input-group">
                        <span title="Cliente" class="input-group-text" id="icon-form"><i class="fa-solid fa-user-tie"></i></span>
                        <input disabled type="text" class="form-control" value="{{$venta->cliente->persona->razon_social}}">
                    </div>
                </div>
            </div>

            <!---Usuario-->
            <div class="row mb-4">
                <div class="col-sm-6">
                    <div class="input-group" id="hide-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input disabled type="text" class="form-control" value="Vendedor: ">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="input-group">
                        <span title="Vendedor" class="input-group-text" id="icon-form"><i class="fa-solid fa-user"></i></span>
                        <input disabled type="text" class="form-control" value="{{$venta->user->name}}">
                    </div>
                </div>
            </div>

            <!---Fecha--->
            <div class="row mb-4">
                <div class="col-sm-6">
                    <div class="input-group" id="hide-group">
                        <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                        <input disabled type="text" class="form-control" value="Fecha: ">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="input-group">
                        <span title="Fecha" class="input-group-text" id="icon-form"><i class="fa-solid fa-calendar-days"></i></span>
                        <input disabled type="text" class="form-control" value="{{ \Carbon\Carbon::parse($venta->fecha_hora)->format('d-m-Y') }}">
                    </div>
                </div>
            </div>

            <!---Hora-->
            <div class="row mb-4">
                <div class="col-sm-6">
                    <div class="input-group" id="hide-group">
                        <span class="input-group-text"><i class="fa-solid fa-clock"></i></span>
                        <input disabled type="text" class="form-control" value="Hora: ">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="input-group">
                        <span title="Hora" class="input-group-text" id="icon-form"><i class="fa-solid fa-clock"></i></span>
                        <input disabled type="text" class="form-control" value="{{ \Carbon\Carbon::parse($venta->fecha_hora)->format('H:i') }}">
                    </div>

                </div>
            </div>

            <!---Impuesto--->
            <div class="row">
                <div class="col-sm-6">
                    <div class="input-group" id="hide-group">
                        <span class="input-group-text"><i class="fa-solid fa-percent"></i></span>
                        <input disabled type="text" class="form-control" value="Impuesto: ">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="input-group">
                        <span title="Impuesto" class="input-group-text" id="icon-form"><i class="fa-solid fa-percent"></i></span>
                        <input id="input-impuesto" disabled type="text" class="form-control" value="{{ $venta->impuesto }}">
                    </div>

                </div>
            </div>
        </div>


    </div>


    <!---Tabla--->
    <div class="card mb-2">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabla de detalle de la venta
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped">
                <thead class="bg-primary text-white">
                    <tr class="align-top">
                        <th class="text-white">Producto</th>
                        <th class="text-white">Cantidad</th>
                        <th class="text-white">Precio de venta</th>
                        <th class="text-white">Descuento</th>
                        <th class="text-white">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($venta->productos as $item)
                    <tr>
                        <td>
                            {{$item->nombre}}
                        </td>
                        <td>
                            {{$item->pivot->cantidad}}
                        </td>
                        <td>
                            {{$item->pivot->precio_venta}}
                        </td>
                        <td>
                            {{$item->pivot->descuento}}
                        </td>
                        <td class="td-subtotal">
                            {{($item->pivot->cantidad) * ($item->pivot->precio_venta) - ($item->pivot->descuento)}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5"></th>
                    </tr>
                    <tr>
                        <th colspan="4">Sumas:</th>
                        <th id="th-suma"></th>
                    </tr>
                    <tr>
                        <th colspan="4">IGV:</th>
                        <th id="th-igv"></th>
                    </tr>
                    <tr>
                        <th colspan="4">Total:</th>
                        <th id="th-total"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>
@endsection

@push('js')
<script>
    //Variables
    let filasSubtotal = document.getElementsByClassName('td-subtotal');
    let cont = 0;
    let impuesto = $('#input-impuesto').val();

    $(document).ready(function() {
        calcularValores();
    });

    function calcularValores() {
        for (let i = 0; i < filasSubtotal.length; i++) {
            cont += parseFloat(filasSubtotal[i].innerHTML);
        }

        $('#th-suma').html(cont);
        $('#th-igv').html(impuesto);
        $('#th-total').html(round(cont + parseFloat(impuesto)));
    }

    function round(num, decimales = 2) {
        var signo = (num >= 0 ? 1 : -1);
        num = num * signo;
        if (decimales === 0) //con 0 decimales
            return signo * Math.round(num);
        // round(x * 10 ^ decimales)
        num = num.toString().split('e');
        num = Math.round(+(num[0] + 'e' + (num[1] ? (+num[1] + decimales) : decimales)));
        // x * 10 ^ (-decimales)
        num = num.toString().split('e');
        return signo * (num[0] + 'e' + (num[1] ? (+num[1] - decimales) : -decimales));
    }
    //Fuente: https://es.stackoverflow.com/questions/48958/redondear-a-dos-decimales-cuando-sea-necesario
</script>
@endpush