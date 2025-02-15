@extends('layouts.app')

@section('title','Inicializar producto')

@push('css')
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Inicializar Producto</h1>

    <x-breadcrumb.template>
        <x-breadcrumb.item :href="route('panel')" content="Inicio" />
        <x-breadcrumb.item :href="route('productos.index')" content="Productos" />
        <x-breadcrumb.item active='true' content="Inicializar producto" />
    </x-breadcrumb.template>

    <div class="mb-4">
        <button type="button"
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#verPlanoModal">
            Ver plano
        </button>
    </div>

    <x-forms.template :action="route('inventario.store')" method='post'>

        <x-slot name='header'>
            <p>Producto: <span class='fw-bold'>{{$producto->nombre_completo}}</span></p>
        </x-slot>

        <div class="row g-4">

            <!-----Producto id---->
            <input type="hidden" name="producto_id" value="{{$producto->id}}">

            <!---Ubicaciones-->
            <div class="col-6">
                <label for="ubicacione_id" class="form-label">Seleccione una ubicación:</label>
                <select name="ubicacione_id"
                    id="ubicaciones_id"
                    class="form-select">
                    @foreach ($ubicaciones as $item)
                    <option value="{{$item->id}}" {{ old('ubicacione_id') == $item->id ? 'selected' : '' }}>
                        {{$item->nombre}}
                    </option>
                    @endforeach
                </select>
                @error('ubicacione_id')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
            </div>

            <!---Cantidad--->
            <div class="col-md-6">
                <x-forms.input id="cantidad" required='true' type='number' />
            </div>

            <!-----Fecha de vencimiento----->
            <div class="col-md-6">
                <x-forms.input id="fecha_vencimiento" type='date' labelText='Fecha de Vencimiento' />
            </div>

              <!-----Costo Unitario----->
              <div class="col-md-6">
                <x-forms.input id="costo_unitario" type='number' labelText='Costo unitario' required='true'/>
            </div>
        </div>

        <x-slot name='footer'>
            <button type="submit" class="btn btn-primary">Inicializar</button>
        </x-slot>

    </x-forms.template>


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

@endpush