<div
    type="button"
    x-ref="trigger"
    x-bind:id="$id('dropdown-button')"
    aria-haspopup="menu"
    x-bind:aria-expanded="open.toString()"
    role="button"
    x-bind:aria-controls="$id('dropdown-menu')"
    @click="toggleAndFocus()"
    @keydown.arrow-down.prevent="openMenu()"
    @keydown.arrow-up.prevent="openMenuAndFocusLast()"
    @keydown.enter.prevent="toggleAndFocus()"
    @keydown.space.prevent="toggleAndFocus()"
    data-dropdown-trigger
    variant="ghost"
    {{ $attributes->merge(['class' => 'w-full select-none']) }}
>
    {{ $slot }}
</div>
