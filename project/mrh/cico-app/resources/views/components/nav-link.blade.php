@props(['active'])

@php
$classes = ($active ?? false)
            ? 'text-white'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-white';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
