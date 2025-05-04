@extends('layouts.app')

@section('title','Empresa')

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Mi empresa</h1>

    <x-breadcrumb.template>
        <x-breadcrumb.item :href="route('panel')" content="Inicio" />
        <x-breadcrumb.item active='true' content="Mi empresa" />
    </x-breadcrumb.template>

    <x-forms.template :action="route('empresa.update',['empresa' => $empresa])" method='post' patch='true'>

        <div class="row g-4">

            <div class="col-md-6">
                <x-forms.input id="nombre" required='true' :defaultValue='$empresa->nombre' />
            </div>

            <div class="col-md-6">
                <x-forms.input id="propietario" required='true' :defaultValue='$empresa->propietario' />
            </div>

            <div class="col-md-6">
                <x-forms.input id="ruc" required='true' :defaultValue='$empresa->ruc' />
            </div>

            <div class="col-md-6">
                <x-forms.input id="direccion" required='true' :defaultValue='$empresa->direccion' />
            </div>

            <div class="col-md-6">
                <x-forms.input id="porcentaje_impuesto" required='true' :defaultValue='$empresa->porcentaje_impuesto'
                    type='number' labelText='Porcentaje del impuesto (%)' />
            </div>

            <div class="col-md-6">
                <x-forms.input id="abreviatura_impuesto" required='true' :defaultValue='$empresa->abreviatura_impuesto'
                    labelText='Abreviatura del impuesto' />
            </div>

            <div class="col-md-4">
                <x-forms.input id="correo" :defaultValue='$empresa->correo' type='email' />
            </div>

            <div class="col-md-4">
                <x-forms.input id="telefono" :defaultValue='$empresa->telefono' />
            </div>

            <div class="col-md-4">
                <x-forms.input id="ubicacion" :defaultValue='$empresa->ubicacion' />
            </div>

            <div class="col-12">
                <label for="moneda_id" class="form-label">Moneda seleccionada:</label>
                <select name="moneda_id" id="moneda_id" class="form-select">
                    @foreach ($monedas as $moneda)
                    <option value="{{$moneda->id}}"
                        {{$empresa->moneda_id == $moneda->id || old('moneda_id') == $moneda->id  ? 'selected' : ''}}>
                        {{$moneda->nombre_completo}}
                    </option>
                    @endforeach
                </select>
                @error('moneda_id')
                <small class="text-danger">{{'* .$messsage'}}</small>
                @enderror
            </div>

        </div>

        @can('update-empresa')
        <x-slot name='footer'>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </x-slot>
        @endcan

    </x-forms.template>


</div>
@endsection

@push('js')
@endpush