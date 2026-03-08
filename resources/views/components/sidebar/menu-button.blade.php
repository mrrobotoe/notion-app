@props([
    'variant' => null,
    'size' => null,
    'href' => null,
    'tooltip' => null
])

@php
    $variantClasses = match($variant) {
        'outline' => "bg-background shadow-[0_0_0_1px_hsl(var(--sidebar-border))] hover:bg-sidebar-accent hover:text-sidebar-accent-foreground hover:shadow-[0_0_0_1px_hsl(var(--sidebar-accent))]",
        default => 'hover:bg-sidebar-accent hover:text-sidebar-accent-foreground'
    };
    $sizeClasses = match($size) {
        'sm' => 'h-7 text-xs',
        'lg' => "h-12 text-sm group-data-[collapsible=icon]:p-0!",
        default => 'h-8 text-sm'
    };
    $defaultClasses =  "peer/menu-button flex w-full items-center gap-2 overflow-hidden rounded-md p-2 text-left text-sm outline-hidden select-none ring-sidebar-ring transition-[width,height,padding] hover:bg-sidebar-accent hover:text-sidebar-accent-foreground focus-visible:ring-2 active:bg-sidebar-accent active:text-sidebar-accent-foreground disabled:pointer-events-none disabled:opacity-50 group-has-data-[sidebar=menu-action]/menu-item:pr-8 aria-disabled:pointer-events-none aria-disabled:opacity-50 data-[active=true]:bg-sidebar-accent data-[active=true]:font-medium data-[active=true]:text-sidebar-accent-foreground data-[state=open]:hover:bg-sidebar-accent data-[state=open]:hover:text-sidebar-accent-foreground group-data-[collapsible=icon]:size-8! group-data-[collapsible=icon]:p-2 [&>span:last-child]:truncate [&>svg]:size-4 [&>svg]:shrink-0"
@endphp

@isset($tooltip)
    <template x-if="sidebarState === 'collapsed'">
        <x-tooltip>
            <x-tooltip.trigger>
                <div
                    {{ $attributes->merge(['class' => "$defaultClasses $variantClasses $sizeClasses"]) }}
                >
                    {{ $slot }}
                </div>
            </x-tooltip.trigger>
            <x-tooltip.content position="right" offsetValue="8">
                {{ $tooltip }}
            </x-tooltip.content>
        </x-tooltip>
    </template>
    <template x-if="sidebarState !== 'collapsed'">
        <div
            {{ $attributes->merge(['class' => "$defaultClasses $variantClasses $sizeClasses"]) }}
        >
            {{ $slot }}
        </div>
    </template>
@else
    <div
        {{ $attributes->merge(['class' => "$defaultClasses $variantClasses $sizeClasses"]) }}
    >
        {{ $slot }}
    </div>
@endisset
