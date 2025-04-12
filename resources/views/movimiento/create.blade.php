@extends('layouts.app')

@section('title','Crear movimiento')

@push('css')
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Nuevo retiro</h1>

    <x-breadcrumb.template>
        <x-breadcrumb.item :href="route('panel')" content="Inicio" />
        <x-breadcrumb.item :href="route('cajas.index')" content="Cajas" />
        <x-breadcrumb.item :href="route('movimientos.index',['caja_id' => $caja_id])"
            content="Movimientos de caja" />
        <x-breadcrumb.item active='true' content="Nuevo retiro" />
    </x-breadcrumb.template>

    <x-forms.template :action="route('movimientos.store')" method='post'>

        <div class="row g-4">

            <div class="col-12">
                <x-forms.input id="descripcion" required='true'
                    labelText="Descripcion del retiro" />
            </div>

            <div class="col-md-6">
                <label for="metodo_pago" class="form-label">
                    Método de retiro:</label>
                <select required name="metodo_pago"
                    id="metodo_pago"
                    class="form-select">
                    @foreach ($optionsMetodoPago as $item)
                    <option value="{{$item->value}}">{{$item->name}}</option>
                    @endforeach
                </select>
                @error('metodo_pago')
                <small class="text-danger">{{ '*'.$message }}</small>
                @enderror
            </div>

            <div class="col-md-6">
                <x-forms.input id="monto" required='true'
                    labelText="Monto del retiro" type='number' />
            </div>

            <input type="hidden" name="caja_id" value='{{$caja_id}}'>
            <input type="hidden" name="tipo" value="RETIRO">

        </div>

        <x-slot name='footer'>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </x-slot>

    </x-forms.template>


</div>
@endsection

@push('js')

@endpush