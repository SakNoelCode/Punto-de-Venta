@extends('layouts.app')

@section('title','Inventario')

@push('css-datatable')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@push('css')
@endpush

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Inventario</h1>

    <x-breadcrumb.template>
        <x-breadcrumb.item :href="route('panel')" content="Inicio" />
        <x-breadcrumb.item active='true' content="Inventario" />
    </x-breadcrumb.template>

    <div class="mb-4">
        <button type="button"
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#verPlanoModal">
            Ver plano
        </button>
    </div>

    <div class="card">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabla inventario
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table-striped fs-6">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Stock</th>
                        <th>Ubicación</th>
                        <th>Fecha de Vencimiento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inventario as $item)
                    <tr>
                        <td>
                            {{$item->producto->nombre_completo}}
                        </td>
                        <td>
                            {{$item->cantidad}}
                        </td>
                        <td>
                            {{$item->ubicacione->nombre}}
                        </td>
                        <td>
                            {{$item->fecha_vencimiento_format ?? $item->fecha_vencimiento_format}}
                        </td>
                        <td>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="verPlanoModal"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Plano de Ubicaciones</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 text-center">
                            <img src="{{ asset('assets/img/plano.png')}}" alt="Plano de ubicaciones"
                                class="img-fluid img-thumbail border rounded">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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