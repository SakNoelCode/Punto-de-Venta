@props([
'action',
'method',
'patch' => false,
'file' => false
])
<div class="card text-bg-light">
    <form action="{{ $action }}" method="{{ $method }}" @if($file) enctype="multipart/form-data" @endif>

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