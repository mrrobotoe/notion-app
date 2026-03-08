@props([
    'size' => null,
    'variant' => null
])

@php
    $sizeClasses = match($size) {
        'icon' => 'size-8',
        'sm' => 'h-9 text-sm px-3 py-1 rounded-md',
        'lg' => 'h-12 text-blase px-4 rounded-lg py-1.5',
        default => 'h-9 px-4 py-2 has-[>svg]:px-3',
    };
    $variantClasses = match($variant) {
        'outline' => 'shadow-xs bg-transparent border border-border hover:bg-input/40',
        'destructive' => 'bg-destructive text-destructive-foreground hover:bg-destructive/80',
        'ghost' => 'bg-transparent hover:bg-input/40',
        default => 'bg-primary text-primary-foreground hover:bg-primary/90'
    };
    $defaultClasses = "inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive data-[loading]:opacity-50";
@endphp

<button
    {{ $attributes->merge(['class' => "$defaultClasses $sizeClasses $variantClasses"]) }}
>
    {{ $slot }}
</button>
