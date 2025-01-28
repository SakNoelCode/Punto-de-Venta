@extends('layouts.app')

@section('title','Crear categoría')

@push('css')
<style>
    #descripcion {
        resize: none;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Crear Categoría</h1>

    <x-breadcrumb.template>
        <x-breadcrumb.item :href="route('panel')" content="Inicio" />
        <x-breadcrumb.item :href="route('categorias.index')" content="Categorías" />
        <x-breadcrumb.item active='true' content="Crear categoría" />
    </x-breadcrumb.template>

    <x-forms.template :action="route('categorias.store')" method='post'>

        <div class="row g-4">

            <div class="col-md-6">
                <x-forms.input id="nombre" required='true' />
            </div>

            <div class="col-12">
                <x-forms.textarea id="descripcion"/>
            </div>
        </div>

        <x-slot name='footer'>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </x-slot>

    </x-forms.template>


</div>
@endsection

@push('js')

@endpush