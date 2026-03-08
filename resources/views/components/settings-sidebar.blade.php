@php
    $navItems = [
            (object) [
                'title' => 'Preferences',
                'route' => 'settings.profile',
                'icon' => 'fa-solid fa-sliders',
            ]
        ];
@endphp

<x-sidebar.wrapper>
    <x-sidebar>
        <x-settings-sidebar-content />
        <x-sidebar.footer>
            <x-sidebar.menu>
                <a href="{{ route('dashboard') }}">
                    <x-sidebar.menu-item>
                        <x-sidebar.menu-button size="lg">
                            <i class="fa-solid fa-arrow-left"></i>
                            <span class="text-icon">
                            {{ __("Go back") }}
                        </span>
                        </x-sidebar.menu-button>
                    </x-sidebar.menu-item>
                </a>
            </x-sidebar.menu>
        </x-sidebar.footer>
    </x-sidebar>
</x-sidebar.wrapper>
