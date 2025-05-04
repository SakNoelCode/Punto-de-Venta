@extends('layouts.app')

@section('title','cajas')

@push('css-datatable')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Cajas</h1>

    <x-breadcrumb.template>
        <x-breadcrumb.item :href="route('panel')" content="Inicio" />
        <x-breadcrumb.item active='true' content="Cajas" />
    </x-breadcrumb.template>

    @can('aperturar-caja')
    <div class="mb-4">
        <a href="{{route('cajas.create')}}">
            <button type="button" class="btn btn-primary">Aperturar caja</button>
        </a>
    </div>
    @endcan


    <div class="card">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabla cajas
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table-striped fs-6">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apertura</th>
                        <th>Cierre</th>
                        <th>Saldo inicial</th>
                        <th>Saldo final</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cajas as $item)
                    <tr>
                        <td>
                            {{$item->nombre}}
                        </td>
                        <td>
                            <p class="fw-semibold mb-1">
                                <span class="m-1"><i class="fa-solid fa-calendar-days"></i></span>
                                {{$item->fecha_apertura}}
                            </p>
                            <p class="fw-semibold mb-0"><span class="m-1"><i class="fa-solid fa-clock"></i></span>
                                {{$item->hora_apertura}}
                            </p>
                        </td>
                        <td>
                            @if ($item->fecha_hora_cierre)
                            <p class="fw-semibold mb-1">
                                <span class="m-1"><i class="fa-solid fa-calendar-days"></i></span>
                                {{$item->fecha_cierre}}
                            </p>
                            <p class="fw-semibold mb-0"><span class="m-1"><i class="fa-solid fa-clock"></i></span>
                                {{$item->hora_cierre}}
                            </p>
                            @endif
                        </td>
                        <td>
                            {{$item->saldo_inicial}}
                        </td>
                        <td>
                            {{$item->saldo_final}}
                        </td>
                        <td>
                            <span class="badge rounded-pill {{ $item->estado == 1 ? 'text-bg-success' : 'text-bg-danger' }}">
                                {{$item->estado == 1 ? 'aperturada' : 'cerrada'}}</span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                @can('ver-movimiento')
                                <form action="{{route('movimientos.index')}}" method="get">
                                    <input type="hidden" name="caja_id" value="{{$item->id}}">
                                    <button type="submit" class="btn btn-success">
                                        Ver
                                    </button>
                                </form>
                                @endcan

                                @can('cerrar-caja')
                                @if ($item->estado == 1)
                                <button type="button" class="btn btn-danger"
                                    data-bs-toggle="modal" data-bs-target="#confirmModal-{{$item->id}}">
                                    Cerrar</button>
                                @endif
                                @endcan

                            </div>
                        </td>
                    </tr>

                    <!-- Modal para cerra la caja-->
                    <div class="modal fade" id="confirmModal-{{$item->id}}" tabindex="-1">
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

                                    <form action="{{route('cajas.destroy',['caja' => $item->id])}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">
                                            Confirmar</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>


                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
<script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
@endpush