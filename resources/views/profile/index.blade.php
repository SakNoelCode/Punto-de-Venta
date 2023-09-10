@extends('layouts.app')

@section('title','Perfil')

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')

@include('layouts.partials.alert')


<div class="container-fluid">
    <h1 class="mt-4 mb-4 text-center">Configurar perfil</h1>

    <div class="card">
        <div class="card-header">
            <p class="lead">Configure y personalize su perfil</p>
        </div>
        <div class="card-body">
            <div class="">
                @if ($errors->any())
                @foreach ($errors->all() as $item)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$item}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endforeach
                @endif
            </div>

            <form action="{{route('profile.update',['profile' => $user ])}}" method="POST">
                @method('PATCH')
                @csrf
                <!----Nombre---->
                <div class="row mb-4">
                    <div class="col-sm-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-square-check"></i></span>
                            <input disabled type="text" class="form-control" value="Nombres">
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <input disabled autocomplete="off" type="text" name="name" id="name" class="form-control" value="{{old('name',$user->name)}}">
                    </div>
                </div>

                <!----Email---->
                <div class="row mb-4">
                    <div class="col-sm-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-square-check"></i></span>
                            <input disabled type="text" class="form-control" value="Email">
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <input disabled autocomplete="off" type="email" name="email" id="email" class="form-control" value="{{old('email',$user->email)}}">
                    </div>
                </div>

                <!----Password--->
                <div class="row mb-4">
                    <div class="col-sm-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-square-check"></i></span>
                            <input disabled type="text" class="form-control" value="Contraseña">
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <input disabled type="password" name="password" id="password" class="form-control">
                    </div>
                </div>

                <div class="col text-center">
                    <input disabled class="btn btn-success" type="submit" value="Guardar cambios">
                </div>

            </form>
        </div>
    </div>

</div>
@endsection

@push('js')

@endpush