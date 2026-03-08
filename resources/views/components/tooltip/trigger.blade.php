<div
    x-ref="trigger"
    x-bind:aria-describedby="$id('tooltip')"
    data-slot="tooltip-trigger"
    @mouseenter="show()"
    @mouseleave="hide()"
    @focusin="show()"
    @focusout="hide()"
>
    {{ $slot }}
</div>
