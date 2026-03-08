<div
    x-data="{ open: false }"
    @click.outside="open = false"
    @close.stop="open = false"
    :data-combobox-open="open"
    class="relative group/combobox"
>
    {{ $slot }}
</div>
