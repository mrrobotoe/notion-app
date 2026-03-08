@props([
    'position' => 'top',
    'align' => 'center',
    'offset' => 4,
])

@php
    $anchorPlacement = match($position) {
        'top' => match($align) {
            'start' => 'top-start',
            'end' => 'top-end',
            default => 'top',
        },
        'left' => match($align) {
            'start' => 'left-start',
            'end' => 'left-end',
            default => 'left',
        },
        'right' => match($align) {
            'start' => 'right-start',
            'end' => 'right-end',
            default => 'right',
        },
        default => match($align) {
            'start' => 'bottom-start',
            'end' => 'bottom-end',
            default => 'bottom',
        },
    };

    $offsetValue = max(0, (int) $offset);
    $baseClasses = "group z-50 bg-foreground text-background border border-border animate-in fade-in-0 zoom-in-95 data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=closed]:zoom-out-95 data-[side=bottom]:slide-in-from-top-2 data-[side=left]:slide-in-from-right-2 data-[side=right]:slide-in-from-left-2 data-[side=top]:slide-in-from-bottom-2 z-50 w-fit rounded-md px-3 py-1.5 text-xs text-balance";
@endphp

<template x-teleport="body">
    <div
        x-cloak
        x-show="open"
        role="tooltip"
        x-anchor.{{ $anchorPlacement }}.offset.{{ $offsetValue }}="$refs.trigger"
        data-side="{{ $position }}"
        data-align="{{ $align }}"
        :id="$id('tooltip')"
        class="{{ $baseClasses }}"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-120"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
    >
        <span
            aria-hidden="true"
            class="pointer-events-none absolute size-2 rotate-45 bg-foreground
                group-data-[side=top]:-bottom-1 group-data-[side=bottom]:-top-1
                group-data-[side=left]:-right-1 group-data-[side=right]:-left-1
                group-data-[side=top]:left-1/2 group-data-[side=bottom]:left-1/2
                group-data-[side=top]:-translate-x-1/2 group-data-[side=bottom]:-translate-x-1/2
                group-data-[side=left]:top-1/2 group-data-[side=right]:top-1/2
                group-data-[side=left]:-translate-y-1/2 group-data-[side=right]:-translate-y-1/2
                group-data-[side=top]:group-data-[align=start]:left-2 group-data-[side=top]:group-data-[align=start]:translate-x-0
                group-data-[side=top]:group-data-[align=end]:right-2 group-data-[side=top]:group-data-[align=end]:left-auto group-data-[side=top]:group-data-[align=end]:translate-x-0
                group-data-[side=bottom]:group-data-[align=start]:left-2 group-data-[side=bottom]:group-data-[align=start]:translate-x-0
                group-data-[side=bottom]:group-data-[align=end]:right-2 group-data-[side=bottom]:group-data-[align=end]:left-auto group-data-[side=bottom]:group-data-[align=end]:translate-x-0
                group-data-[side=left]:group-data-[align=start]:top-2 group-data-[side=left]:group-data-[align=start]:translate-y-0
                group-data-[side=left]:group-data-[align=end]:bottom-2 group-data-[side=left]:group-data-[align=end]:top-auto group-data-[side=left]:group-data-[align=end]:translate-y-0
                group-data-[side=right]:group-data-[align=start]:top-2 group-data-[side=right]:group-data-[align=start]:translate-y-0
                group-data-[side=right]:group-data-[align=end]:bottom-2 group-data-[side=right]:group-data-[align=end]:top-auto group-data-[side=right]:group-data-[align=end]:translate-y-0"
        ></span>
        {{ $slot }}
    </div>
</template>
