@php
    $breadcrumbs = [
            (object) [
                'title' => 'Dashboard',
                'route' => 'dashboard'
            ]
        ];
@endphp

<x-layouts.app>
    <div class="px-4">
        <x-slot:breadcrumbs>
            <x-app-breadcrumbs :$breadcrumbs />
        </x-slot:breadcrumbs>
        <div class="py-6">
            <h1 class="text-foreground">{{ __('Dashboard') }}</h1>
        </div>
    </div>
</x-layouts.app>
