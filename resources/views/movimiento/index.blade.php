@extends('layouts.app')

@section('title','movimientos')

@push('css-datatable')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Movimientos de caja</h1>

    <x-breadcrumb.template>
        <x-breadcrumb.item :href="route('panel')" content="Inicio" />
        <x-breadcrumb.item :href="route('cajas.index')" content="Cajas" />
        <x-breadcrumb.item active='true' content="Movimientos de caja" />
    </x-breadcrumb.template>

    <div class="card mb-4">
        <div class="card-header">
            {{$caja->nombre}}
        </div>
        <div class="card-body">
            <h6 class="card-subtitle mb-2 text-body-secondary">
                Apertura: {{$caja->fecha_apertura}} - {{$caja->hora_apertura}}</h6>
            @if ($caja->fecha_hora_cierre)
            <h6 class="card-subtitle mb-2 text-body-secondary">
                Cierre: {{$caja->fecha_cierre}} - {{$caja->hora_cierre}}</h6>
            @endif
            <h6 class="card-subtitle mb-2 text-body-secondary">
                Saldo inicial: {{$caja->saldo_inicial}}</h6>
            @if ($caja->saldo_final)
            <h6 class="card-subtitle mb-2 text-body-secondary">
                Saldo final: {{$caja->saldo_final}}</h6>
            @endif

            <hr>
            @if ($caja->estado == 1)
            @can('crear-venta')
            <a href="{{route('ventas.create')}}">
                <button type="button" class="btn btn-primary">Nueva venta</button>
            </a>
            @endcan

            @can('crear-movimiento')
            <a href="{{route('movimientos.create',['caja_id' => $caja->id])}}">
                <button type="button" class="btn btn-success">Nuevo retiro</button>
            </a>
            @endcan

            @can('cerrar-caja')
            <button type="button" class="btn btn-danger"
                data-bs-toggle="modal" data-bs-target="#confirmModal-{{$caja->id}}">
                Cerrar</button>
            @endcan

            @endif


        </div>

    </div>

    <div class="card">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabla movimientos
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table-striped fs-6">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Descripción</th>
                        <th>Monto</th>
                        <th>Método de pago</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($caja->movimientos as $item)
                    <tr>
                        <td>
                            {{$item->tipo->value}}
                        </td>
                        <td>
                            {{$item->descripcion}}
                        </td>
                        <td>
                            {{$item->monto}}
                        </td>
                        <td>
                            {{$item->metodo_pago->value}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <!-- Modal para cerra la caja-->
    <div class="modal fade" id="confirmModal-{{$caja->id}}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">
                        Mensaje de confirmación</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    ¿Seguro que quieres cerrar la caja?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar</button>

                    <form action="{{route('cajas.destroy',['caja' => $caja->id])}}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            Confirmar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
<script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
@endpush