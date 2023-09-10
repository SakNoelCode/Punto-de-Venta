@extends('layouts.app')

@section('title','Editar Producto')

@push('css')
<style>
    #descripcion {
        resize: none;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Editar Producto</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('productos.index')}}">Productos</a></li>
        <li class="breadcrumb-item active">Editar producto</li>
    </ol>

    <div class="card text-bg-light">
        <form action="{{route('productos.update',['producto'=>$producto])}}" method="post" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="card-body">

                <div class="row g-4">
                    <!----Codigo---->
                    <div class="col-md-6">
                        <label for="codigo" class="form-label">Código:</label>
                        <input type="text" name="codigo" id="codigo" class="form-control" value="{{old('codigo',$producto->codigo)}}">
                        @error('codigo')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                    <!---Nombre---->
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{old('nombre',$producto->nombre)}}">
                        @error('nombre')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                    <!---Descripción---->
                    <div class="col-12">
                        <label for="descripcion" class="form-label">Descripción:</label>
                        <textarea name="descripcion" id="descripcion" rows="3" class="form-control">{{old('descripcion',$producto->descripcion)}}</textarea>
                        @error('descripcion')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                    <!---Fecha de vencimiento---->
                    <div class="col-md-6">
                        <label for="fecha_vencimiento" class="form-label">Fecha de vencimiento:</label>
                        <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control" value="{{old('fecha_vencimiento',$producto->fecha_vencimiento)}}">
                        @error('fecha_vencimiento')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                    <!---Imagen---->
                    <div class="col-md-6">
                        <label for="img_path" class="form-label">Imagen:</label>
                        <input type="file" name="img_path" id="img_path" class="form-control" accept="image/*">
                        @error('img_path')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                    <!---Marca---->
                    <div class="col-md-6">
                        <label for="marca_id" class="form-label">Marca:</label>
                        <select data-size="4" title="Seleccione una marca" data-live-search="true" name="marca_id" id="marca_id" class="form-control selectpicker show-tick">
                            @foreach ($marcas as $item)
                            @if ($producto->marca_id == $item->id)
                            <option selected value="{{$item->id}}" {{ old('marca_id') == $item->id ? 'selected' : '' }}>{{$item->nombre}}</option>
                            @else
                            <option value="{{$item->id}}" {{ old('marca_id') == $item->id ? 'selected' : '' }}>{{$item->nombre}}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('marca_id')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                    <!---Presentaciones---->
                    <div class="col-md-6">
                        <label for="presentacione_id" class="form-label">Presentación:</label>
                        <select data-size="4" title="Seleccione una presentación" data-live-search="true" name="presentacione_id" id="presentacione_id" class="form-control selectpicker show-tick">
                            @foreach ($presentaciones as $item)
                            @if ($producto->presentacione_id == $item->id)
                            <option selected value="{{$item->id}}" {{ old('presentacione_id') == $item->id ? 'selected' : '' }}>{{$item->nombre}}</option>
                            @else
                            <option value="{{$item->id}}" {{ old('presentacione_id') == $item->id ? 'selected' : '' }}>{{$item->nombre}}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('presentacione_id')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                    <!---Categorías---->
                    <div class="col-md-6">
                        <label for="categorias" class="form-label">Categorías:</label>
                        <select data-size="4" title="Seleccione las categorías" data-live-search="true" name="categorias[]" id="categorias" class="form-control selectpicker show-tick" multiple>
                            @foreach ($categorias as $item)
                            @if (in_array($item->id,$producto->categorias->pluck('id')->toArray()))
                            <option selected value="{{$item->id}}" {{ (in_array($item->id , old('categorias',[]))) ? 'selected' : '' }}>{{$item->nombre}}</option>
                            @else
                            <option value="{{$item->id}}" {{ (in_array($item->id , old('categorias',[]))) ? 'selected' : '' }}>{{$item->nombre}}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('categorias')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>
                </div>

            </div>
            <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="reset" class="btn btn-secondary">Reiniciar</button>
            </div>
        </form>
    </div>



</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
@endpush