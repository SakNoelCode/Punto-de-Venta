@extends('layouts.app')

@section('title','Editar cliente')

@push('css')

@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Editar Cliente</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('clientes.index')}}">Clientes</a></li>
        <li class="breadcrumb-item active">Editar cliente</li>
    </ol>

    <div class="card text-bg-light">
        <form action="{{ route('clientes.update',['cliente'=>$cliente]) }}" method="post">
            @method('PATCH')
            @csrf
            <div class="card-header">
                <p>Tipo de cliente: <span class="fw-bold">
                        {{ strtoupper($cliente->persona->tipo->value)}}
                    </span></p>
            </div>
            <div class="card-body">

                <div class="row g-3">

                    <!-------Razón social------->
                    <div class="col-12">
                        <label id="label-juridica" for="razon_social" class="form-label">
                            {{ $cliente->persona->tipo->value == 'NATURAL' ? 'Nombres y apellidos:' : 'Nombre de la empresa:'}}
                        </label>
                        <input required
                            type="text"
                            name="razon_social"
                            id="razon_social"
                            class="form-control"
                            value="{{old('razon_social',$cliente->persona->razon_social)}}">
                        @error('razon_social')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                    <!------Dirección---->
                    <div class="col-12">
                        <label for="direccion" class="form-label">Dirección:</label>
                        <input type="text"
                            name="direccion"
                            id="direccion"
                            class="form-control"
                            value="{{old('direccion',$cliente->persona->direccion)}}">
                        @error('direccion')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                    <!------Email---->
                    <div class="col-md-6">
                        <x-forms.input id="email"
                            type='email'
                            labelText='Correo eléctronico'
                            :defaultValue='$cliente->persona->email' />
                    </div>

                    <!------Telefono---->
                    <div class="col-md-6">
                        <x-forms.input id="telefono"
                            type='number'
                            :defaultValue='$cliente->persona->telefono' />
                    </div>

                    <!--------------Documento------->
                    <div class="col-md-6">
                        <label for="documento_id" class="form-label">
                            Tipo de documento:</label>
                        <select class="form-select" name="documento_id" id="documento_id">
                            @foreach ($documentos as $item)
                            <option value="{{ $item->id }}"
                                {{ old('documento_id', $cliente->persona->documento_id) == $item->id ? 'selected' : '' }}>
                                {{ $item->nombre }}
                            </option>
                            @endforeach
                        </select>
                        @error('documento_id')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="numero_documento" class="form-label">Numero de documento:</label>
                        <input required
                            type="text"
                            name="numero_documento"
                            id="numero_documento"
                            class="form-control"
                            value="{{old('numero_documento',$cliente->persona->numero_documento)}}">
                        @error('numero_documento')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                </div>

            </div>
            <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')

@endpush