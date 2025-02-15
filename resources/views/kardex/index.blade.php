@extends('layouts.app')

@section('title','Kardex')

@push('css-datatable')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endpush

@push('css')
@endpush

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Kardex</h1>

    <x-breadcrumb.template>
        <x-breadcrumb.item :href="route('panel')" content="Inicio" />
        <x-breadcrumb.item active='true' content="Kardex" />
    </x-breadcrumb.template>

    <div class="mb-3">
        <form action="{{route('kardex.index')}}" method="get">
            <div class="row gy-2">
                <label for="producto_id" class="col-sm-2 col-form-label">
                    Producto</label>
                <div class="col-sm-8">
                    <select name="producto_id" id="producto_id"
                        class="form-control selectpicker"
                        data-live-search='true' data-size='3' title='Busque un producto aquí'>
                        @foreach ($productos as $item)
                        <option value="{{$item->id}}" {{$item->id == $producto_id ? 'selected': ''}}>
                            {{$item->nombre_completo}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary">
                        Buscar</button>
                </div>
            </div>
        </form>
    </div>

    @if ($kardex->count())
    <div class="card">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabla kardex del producto
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table-striped fs-6">
                <thead>
                    <tr>
                        <th>Fecha y Hora</th>
                        <th>Transacción</th>
                        <th>Descripción </th>
                        <th>Entrada</th>
                        <th>Salida</th>
                        <th>Saldo</th>
                        <th>Costo unitario</th>
                        <th>Costo total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kardex as $item)
                    <tr>
                        <td>
                            {{$item->fecha}} - {{$item->hora}}
                        </td>
                        <td>
                            {{$item->tipo_transaccion}}
                        </td>
                        <td>
                            {{$item->descripcion_transaccion}}
                        </td>
                        <td>
                            {{$item->entrada}}
                        </td>
                        <td>
                            {{$item->salida}}
                        </td>
                        <td>
                            {{$item->saldo}}
                        </td>
                        <td>
                            {{$item->costo_unitario}}
                        </td>
                        <td>
                            {{$item->costo_total}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    @else
    <p class="text-center my-5">Sin datos</p>
    @endif


</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
<script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
@endpush