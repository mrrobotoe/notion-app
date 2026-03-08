@props([
    'type' => 'div'
])

@if($type == 'div')
    <div tabindex="0" {{ $attributes->merge(['class' => 'inline-flex items-center gap-1 w-full p-2 text-sm rounded-md hover:bg-accent select-none text-accent-foreground [&>i]:text-neutral-600/90 outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-1']) }}>
        {{ $slot }}
    </div>
@else
    <button tabindex="0" {{ $attributes->merge(['class' => 'text-start inline-flex items-center gap-1 w-full p-2 text-sm rounded-md hover:bg-accent select-none text-accent-foreground [&>i]:text-neutral-600/90 outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-1']) }}>
        {{ $slot }}
    </button>
@endif
