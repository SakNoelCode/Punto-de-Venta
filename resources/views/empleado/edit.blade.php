@extends('layouts.app')

@section('title','Editar empleado')

@push('css')
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Crear Empleado</h1>

    <x-breadcrumb.template>
        <x-breadcrumb.item :href="route('panel')" content="Inicio" />
        <x-breadcrumb.item :href="route('empleados.index')" content="Empleados" />
        <x-breadcrumb.item active='true' content="Editar empleado" />
    </x-breadcrumb.template>

    <x-forms.template :action="route('empleados.update',['empleado'=> $empleado])"
        method='post'
        file='true'
        patch='true'>

        <div class="row g-4">

            <div class="col-md-6">
                <x-forms.input id="razon_social"
                    required='true'
                    labelText='Nombres y Apellidos'
                    :defaultValue='$empleado->razon_social' />
            </div>

            <div class="col-md-6">
                <x-forms.input id="cargo" required='true' :defaultValue='$empleado->cargo' />
            </div>

            <div class="col-md-6">
                <x-forms.input id="img" type='file' labelText='Seleccione Imagen' />
            </div>

            <div class="col-md-6">
                <p>Imagen seleccionada:</p>

                <img id="img-default"
                    class="img-fluid"
                    src="{{ $empleado->img_path ? asset($empleado->img_path) : asset('assets/img/paisaje.png') }}"
                    alt="Imagen por defecto">

                <img src="" alt="Ha cargado un archivo no compatible"
                    id="img-preview"
                    class="img-fluid img-thumbnail" style="display: none;">
            </div>


        </div>

        <x-slot name='footer'>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </x-slot>

    </x-forms.template>


</div>
@endsection

@push('js')
<script>
    const inputImagen = document.getElementById('img');
    const imagenPreview = document.getElementById('img-preview');
    const imagenDefault = document.getElementById('img-default');

    inputImagen.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                imagenPreview.src = e.target.result;
                imagenPreview.style.display = 'block';
                imagenDefault.style.display = 'none';
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
@endpush