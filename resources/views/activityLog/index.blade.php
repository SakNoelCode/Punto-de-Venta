@extends('layouts.app')

@section('title','Registro de actividad')

@push('css-datatable')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@push('css')
@endpush

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Registro de actividad</h1>

    <br>

    <div class="card">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabla Registro de actividad
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table-striped fs-6">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Acción</th>
                        <th>Módulo</th>
                        <th>Ejecutado el</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activityLogs as $log)
                    <tr>
                        <td>
                            {{$log->user->name}}
                        </td>
                        <td>
                            {{$log->action}}
                        </td>
                        <td>
                           {{$log->module}}
                        </td>
                        <td>
                            {{$log->created_at_formatted}}
                        </td>
                    </tr>
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