@props(['size' => 'md'])

@php
    $sizeClasses = match($size) {
        'sm' => 'size-6',
        'lg' => 'size-12',
        default => 'size-8'
    }
@endphp
<span
    data-avatar
    {{ $attributes->merge(['class' => 'relative shrink-0 overflow-hidden rounded-full ' . $sizeClasses]) }}
>
    {{ $slot }}
</span>
