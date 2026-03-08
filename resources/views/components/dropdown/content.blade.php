@props([
    'position' => 'top',
    'align' => 'start',
    'teleport' => true,
])

@php
    $positionClasses = match($position) {
        'top' => 'bottom-full mb-2',
        'left' => 'right-full mr-2',
        'right' => 'left-full ml-2',
        default => 'top-full mt-2',
    };

    $alignClasses = match($position) {
        'left', 'right' => match($align) {
            'center' => 'top-1/2 -translate-y-1/2',
            'end' => 'bottom-0',
            default => 'top-0',
        },
        default => match($align) {
            'center' => 'left-1/2 -translate-x-1/2',
            'end' => 'right-0',
            default => 'left-0',
        },
    };

    $anchorPlacement = match($position) {
        'top' => match($align) {
            'center' => 'top',
            'end' => 'top-end',
            default => 'top-start',
        },
        'left' => match($align) {
            'center' => 'left',
            'end' => 'left-end',
            default => 'left-start',
        },
        'right' => match($align) {
            'center' => 'right',
            'end' => 'right-end',
            default => 'right-start',
        },
        default => match($align) {
            'center' => 'bottom',
            'end' => 'bottom-end',
            default => 'bottom-start',
        },
    };

    $baseClasses = "absolute z-50 outline-none bg-popover text-popover-foreground data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0 data-[state=closed]:zoom-out-95 data-[state=open]:zoom-in-95 data-[side=bottom]:slide-in-from-top-2 data-[side=left]:slide-in-from-right-2 data-[side=right]:slide-in-from-left-2 data-[side=top]:slide-in-from-bottom-2 min-w-[8rem] overflow-x-hidden overflow-y-auto rounded-xl border p-1 shadow-md";
    $defaultClasses = $teleport
        ? $baseClasses
        : "$baseClasses $positionClasses $alignClasses";
@endphp

<template x-teleport="body">
    <ul
        x-ref="menu"
        x-cloak
        x-show="open"
        data-state="open"
        role="menu"
        x-trap="open"
        tabindex="-1"
        x-anchor.{{ $anchorPlacement }}.offset.3="$refs.trigger"
        data-side="{{ $position }}"
        data-align="{{ $align }}"
        data-dropdown-content
        :id="$id('dropdown-menu')"
        :aria-labelledby="$id('dropdown-button')"
        @keydown.arrow-down.prevent="focusNextItem()"
        @keydown.arrow-up.prevent="focusPrevItem()"
        @keydown.home.prevent="focusFirstItem()"
        @keydown.end.prevent="focusLastItem()"
        @keydown.tab.prevent="focusNextItem()"
{{--        @keydown.tab="close()"--}}
        @keydown.escape.prevent="close()"
        @click.stop
        {{ $attributes->merge(['class' => $defaultClasses]) }}
    >
        {{ $slot }}
    </ul>
</template>
