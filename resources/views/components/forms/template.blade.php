@props([
'action',
'method',
'patch' => false
])
<div class="card text-bg-light">
    <form action="{{ $action }}" method="{{ $method }}">

        @if ($patch)
        @method('PATCH')
        @endif

        @csrf

        @if (isset($header))
        <div class="card-header">
            {{$header}}
        </div>
        @endif

        <div class="card-body">
            {{$slot}}
        </div>

        <div class="card-footer text-center">
            {{$footer}}
        </div>

    </form>
</div>