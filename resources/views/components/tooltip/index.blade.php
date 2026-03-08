<div
    x-data="{
        open: false,
        show() { this.open = true; },
        hide() { this.open = false; }
    }"
    x-id="['tooltip']"
    @keydown.escape.stop.prevent="hide()"
    class="inline-flex"
>
    {{ $slot }}
</div>
