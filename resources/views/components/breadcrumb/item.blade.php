@props([
'active' => false,
'href' => null,
'content'
])

<li {{ $attributes->merge(['class' => 'breadcrumb-item ' . ($active ? 'active' : '')]) }}>
    @if ($href)
    <a href="{{ $href }}">
        {{ $content }}
    </a>
    @else
    {{ $content }}
    @endif
</li>