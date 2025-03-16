@extends('layouts.app')

@section('title','Ver compra')

@push('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endpush

@section('content')
<div class="container-fluid">
    <h1 class="mt-4 text-center">Ver Compra</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('compras.index')}}">Compras</a></li>
        <li class="breadcrumb-item active">Ver Compra</li>
    </ol>
</div>

<div class="container-fluid">

    <div class="card mb-4">
        <div class="card-header">
            Datos generales de la compra
        </div>

        <div class="card-body">
            <h6 class="card-subtitle mb-3 text-body-secondary">
                Comprobante: {{$compra->comprobante->nombre}} ({{$compra->numero_comprobante}})</h6>
            <h6 class="card-subtitle mb-3 text-body-secondary">
                Proveedor: {{$compra->proveedore->persona->razon_social}}</h6>
            <h6 class="card-subtitle mb-3 text-body-secondary">
                Usuario: {{$compra->user->name}}</h6>
            <h6 class="card-subtitle mb-3 text-body-secondary">
                Método de pago: {{$compra->metodo_pago}}</h6>
            <h6 class="card-subtitle mb-3 text-body-secondary">
                Fecha y hora: {{$compra->fecha}} - {{$compra->hora}}</h6>
        </div>
    </div>


    <!---Tabla--->
    <div class="card mb-2">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabla de detalle de la compra
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped">
                <thead class="bg-primary">
                    <tr class="align-top">
                        <th class="text-white">Producto</th>
                        <th class="text-white">Presentación</th>
                        <th class="text-white">Cantidad</th>
                        <th class="text-white">Precio de compra</th>
                        <th class="text-white">Fecha de vencimiento</th>
                        <th class="text-white">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($compra->productos as $item)
                    <tr>
                        <td>
                            {{$item->nombre}}
                        </td>
                        <td>
                            {{$item->presentacione->sigla}}
                        </td>
                        <td>
                            {{$item->pivot->cantidad}}
                        </td>
                        <td>
                            {{$item->pivot->precio_compra}}
                        </td>
                        <td>
                            {{$item->pivot->fecha_vencimiento}}
                        </td>
                        <td class="td-subtotal">
                            {{($item->pivot->cantidad) * ($item->pivot->precio_compra)}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="6"></th>
                    </tr>
                    <tr>
                        <th colspan="5">Sumas:</th>
                        <th>
                            <span id="th-suma"></span>
                            <span>{{$empresa->moneda->simbolo}}</span>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="5">{{$empresa->abreviatura_impuesto}}:</th>
                        <th>{{$compra->impuesto}} {{$empresa->moneda->simbolo}}</th>
                    </tr>
                    <tr>
                        <th colspan="5">Total:</th>
                        <th>{{$compra->total}} {{$empresa->moneda->simbolo}}</th>
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

    $(document).ready(function() {
        calcularValores();
    });

    function calcularValores() {
        for (let i = 0; i < filasSubtotal.length; i++) {
            cont += parseFloat(filasSubtotal[i].innerHTML);
        }

        $('#th-suma').html(cont);
    }
</script>
@endpush