@extends('layouts.app')

@section('title','Editar presentación')

@push('css')
<style>
    #descripcion {
        resize: none;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Editar Presentación</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('presentaciones.index')}}">Presentaciones</a></li>
        <li class="breadcrumb-item active">Editar presentación</li>
    </ol>

    <div class="card text-bg-light">
        <form action="{{ route('presentaciones.update',['presentacione'=>$presentacione]) }}" method="post">
            @method('PATCH')
            @csrf
            <div class="card-body">

                <div class="row g-4">

                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{old('nombre',$presentacione->caracteristica->nombre)}}">
                        @error('nombre')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="descripcion" class="form-label">Descripción:</label>
                        <textarea name="descripcion" id="descripcion" rows="3" class="form-control">{{old('descripcion',$presentacione->caracteristica->descripcion)}}</textarea>
                        @error('descripcion')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                </div>

            </div>
            <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <button type="reset" class="btn btn-secondary">Reiniciar</button>
            </div>
        </form>
    </div>


</div>
@endsection

@push('js')
@endpush