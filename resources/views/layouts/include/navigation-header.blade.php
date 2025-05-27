<?php

use App\Models\Empresa;

$empresa = Empresa::first();
?>
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="{{ route('panel') }}">{{$empresa->nombre ?? ''}}</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input name="search" class="form-control" type="text" placeholder="Buscar ...." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
    </form>
    <div class="nav-item dropdown me-3">
        <a class="nav-link dropdown-toggle" href="#" role="button" id="notificationsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-bell"></i>
            <span class="badge bg-danger rounded-pill">{{ Auth::user()->unreadNotifications->count() }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationsDropdown" style="min-width: 300px;">
            @forelse (Auth::user()->unreadNotifications->take(5) as $notification)
            <li>
                <a href="#" class="dropdown-item">
                    {{ $notification->data['message'] ?? 'Nueva notificación' }}
                    <br>
                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                </a>
            </li>
            @empty
            <li>
                <span class="dropdown-item text-muted">Sin notificaciones nuevas</span>
            </li>
            @endforelse
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item text-center" href="#">Ver todas</a></li>
        </ul>
    </div>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                @can('ver-perfil')
                <li><a class="dropdown-item" href="{{ route('profile.index') }}">Configuraciones</a></li>
                @endcan
                @can('ver-registro-actividad')
                <li><a class="dropdown-item" href="{{ route('activityLog.index') }}">Registro de actividad</a></li>
                @endcan
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li><a class="dropdown-item" href="{{ route('logout') }}">Cerrar sesión</a></li>
            </ul>
        </li>
    </ul>
</nav>