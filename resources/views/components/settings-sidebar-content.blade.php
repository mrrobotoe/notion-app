@php
    $navItems =
    [
        (object) [
            'label' => 'Account',
            'menuItems' => [
                (object) [
                    'title' => 'Profile',
                    'route' => 'settings.profile',
                    'icon' => 'fa-solid fa-user'
                ],
                (object) [
                    'title' => 'Preferences',
                    'route' => 'settings.profile',
                    'icon' => 'fa-solid fa-sliders'
                ],
                (object) [
                    'title' => 'Notifications',
                    'route' => 'settings.profile',
                    'icon' => 'fa-solid fa-bell'
                ],
            ]
        ],
        (object) [
            'label' => 'Workspace',
            'menuItems' => [
                (object) [
                    'title' => 'General',
                    'route' => 'settings.profile',
                    'icon' => 'fa-solid fa-gear'
                ],
                (object) [
                    'title' => 'People',
                    'route' => 'settings.profile',
                    'icon' => 'fa-solid fa-users'
                ]
            ]
        ]
    ];
@endphp

<x-sidebar.content>
    <x-sidebar.group>
        @foreach ($navItems as $item)
            <x-sidebar.group-label>
                {{ $item->label }}
            </x-sidebar.group-label>
            <x-sidebar.menu>
                @foreach ($item->menuItems as $menuItem)
                    <a href="{{ $menuItem->route }}">
                        <x-sidebar.menu-item>
                            <x-sidebar.menu-button>
                                <i class="{{ $menuItem->icon }}"></i>
                                <a href="{{ $menuItem->route }}">{{ $menuItem->title }}</a>
                            </x-sidebar.menu-button>
                        </x-sidebar.menu-item>
                    </a>
                @endforeach
            </x-sidebar.menu>
            <div class="h-px w-full py-2"></div>
        @endforeach
    </x-sidebar.group>

{{--    <x-sidebar.group>--}}
{{--        <x-sidebar.group-label>--}}
{{--            Platform--}}
{{--        </x-sidebar.group-label>--}}
{{--        <x-sidebar.menu>--}}

{{--            @foreach ($navItems as $item)--}}
{{--                <x-sidebar.menu-item>--}}
{{--                    <template x-if="isExpanded">--}}
{{--                        @if(@isset($item->items) && count($item->items) > 0)--}}
{{--                            <x-collapsible>--}}
{{--                                <x-slot:trigger>--}}
{{--                                    <div x-on:mouseover="showTooltip = true" x-on:mouseleave="showTooltip = false" x-on:click="expanded = !expanded">--}}
{{--                                        <x-sidebar.menu-button--}}
{{--                                        >--}}
{{--                                            <i class="{{ $item->icon }}"></i>--}}
{{--                                            <span>{{ $item->title }}</span>--}}
{{--                                            <span class="ml-auto p-1 flex items-center justify-center text-sidebar-accent-foreground">--}}
{{--                                                    <i x-show="expanded" class="fa-solid fa-chevron-down" style="font-size: 0.8em"></i>--}}
{{--                                                    <i x-show="!expanded" class="fa-solid fa-chevron-right" style="font-size: 0.8em"></i>--}}
{{--                                                </span>--}}
{{--                                        </x-sidebar.menu-button>--}}
{{--                                    </div>--}}
{{--                                </x-slot:trigger>--}}
{{--                                <x-slot:content>--}}
{{--                                    @if(@isset($item->items))--}}
{{--                                        <x-sidebar.menu-sub>--}}
{{--                                            @foreach ($item->items as $subItem)--}}
{{--                                                <x-sidebar.menu-sub-item>--}}
{{--                                                    <x-sidebar.menu-button>--}}
{{--                                                        {{ $subItem->title }}--}}
{{--                                                    </x-sidebar.menu-button>--}}
{{--                                                </x-sidebar.menu-sub-item>--}}
{{--                                            @endforeach--}}
{{--                                        </x-sidebar.menu-sub>--}}
{{--                                    @endif--}}
{{--                                </x-slot:content>--}}
{{--                            </x-collapsible>--}}
{{--                        @else--}}
{{--                            <x-sidebar.menu-button--}}
{{--                            >--}}
{{--                                <i class="{{ $item->icon }}"></i>--}}
{{--                                <span>{{ $item->title }}</span>--}}
{{--                            </x-sidebar.menu-button>--}}
{{--                        @endif--}}
{{--                    </template>--}}

{{--                    <template x-if="!isExpanded">--}}
{{--                        <x-tooltip>--}}
{{--                            <x-slot:trigger>--}}
{{--                                <a href="{{ route($item->route) }}" x-on:mouseover="showTooltip = true" x-on:mouseleave="showTooltip = false">--}}
{{--                                    <x-sidebar.menu-button--}}
{{--                                        data-active="{{ request()->routeIs($item->route) ? 'true' : 'false' }}"--}}
{{--                                    >--}}
{{--                                        <i class="{{ $item->icon }}"></i>--}}
{{--                                        <span>{{ $item->title }}</span>--}}
{{--                                    </x-sidebar.menu-button>--}}
{{--                                </a>--}}
{{--                            </x-slot:trigger>--}}
{{--                            <x-tooltip.content direction="right">--}}
{{--                                {{ $item->title }}--}}
{{--                            </x-tooltip.content>--}}
{{--                        </x-tooltip>--}}
{{--                    </template>--}}
{{--                </x-sidebar.menu-item>--}}
{{--            @endforeach--}}
{{--        </x-sidebar.menu>--}}
{{--    </x-sidebar.group>--}}
</x-sidebar.content>
