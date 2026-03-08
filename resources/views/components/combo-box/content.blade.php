@props([
    'position' => '',
    'side' => 'right'
])

@teleport('body')
<div
    x-show="open"
    @switch($position)
        @case("right-start")
            x-transition.origin.top.left
            x-anchor.right-end="$refs.dropdown"
            @break
        @case("right-end")
            x-transition.origin.bottom.left
            x-anchor.right-start="$refs.dropdown"
            @break
        @case("left-start")
            x-transition.origin.top.right.offset.10
            x-anchor.left-start="$refs.dropdown"
            @break
        @case("left-end")
            x-transition.origin.bottom.right
            x-anchor.left-end="$refs.dropdown"
            @break
        @case("bottom-end")
            x-transition.origin.top.right
            x-anchor.bottom-end.offset.5="$refs.dropdown"
            @break
        @case("bottom-start")
            x-transition.origin.top.left
            x-anchor.bottom-start.offset.5="$refs.dropdown"
            @break
        @case("top-base")
            x-transition.origin.bottom.left
            x-anchor.left-end="$refs.dropdown"
            @break
        @default
            x-transition.origin.bottom
            x-anchor.bottom="$refs.dropdown"
       @endswitch
    {{ $attributes->merge([
        'class' => "z-50 h-fit w-56 px-1 py-1 bg-popover border border-border rounded-lg shadow-lg"
    ])}}
    style="display: none;"
    x-cloak
>
    {{ $slot }}
</div>
@endteleport
