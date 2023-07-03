@extends('template')

@section('title','presentaciones')

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@section('content')

@if (session('success'))
<script>
    let message = "{{ session('success') }}";
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: 'success',
        title: message
    })
</script>
@endif

<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Presentaciones</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Presentaciones</li>
    </ol>

    @can('crear-presentacione')
    <div class="mb-4">
        <a href="{{route('presentaciones.create')}}">
            <button type="button" class="btn btn-primary">Añadir nuevo registro</button>
        </a>
    </div>
    @endcan

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabla presentaciones
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($presentaciones as $item)
                        <tr>
                            <td>
                                {{$item->caracteristica->nombre}}
                            </td>
                            <td>
                                {{$item->caracteristica->descripcion}}
                            </td>
                            <td>
                                @if ($item->caracteristica->estado == 1)
                                <span class="badge rounded-pill text-bg-success d-inline">activo</span>
                                @else
                                <span class="badge rounded-pill text-bg-danger d-inline">eliminado</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">

                                    @can('editar-presentacione')
                                    <form action="{{route('presentaciones.edit',['presentacione'=>$item])}}" method="get">
                                        <button type="submit" class="btn btn-warning">Editar</button>
                                    </form>
                                    @endcan

                                    @can('eliminar-presentacione')
                                    @if ($item->caracteristica->estado == 1)
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$item->id}}">Eliminar</button>
                                    @else
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$item->id}}">Restaurar</button>
                                    @endif
                                    @endcan
                                </div>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="confirmModal-{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de confirmación</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        {{ $item->caracteristica->estado == 1 ? '¿Seguro que quieres eliminar la presentación?' : '¿Seguro que quieres restaurar la presentación?' }}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <form action="{{ route('presentaciones.destroy',['presentacione'=>$item->id]) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Confirmar</button>
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

</div>
@endsection


@push('js')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
<script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
@endpush