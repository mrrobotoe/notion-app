@php
    $navItems = [
            (object) [
                'title' => 'Dashboard',
                'route' => 'dashboard',
                'icon' => 'fa-solid fa-rectangle-list',
                'items' => [
                    (object) [
                        'title' => 'Spring2026',
                        'route' => 'dashboard'
                    ],
                    (object) [
                        'title' => 'Fall2026',
                        'route' => 'dashboard'
                    ]
                ]
            ]
        ];
@endphp

<x-sidebar.wrapper>
    <x-sidebar>
        <x-app-sidebar-header />
        <x-sidebar.rail />
    </x-sidebar>
</x-sidebar.wrapper>

