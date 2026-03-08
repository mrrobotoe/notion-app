<!DOCTYPE html>
<html
    x-cloak
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    x-data="{
      darkMode: localStorage.getItem('darkMode')
      || localStorage.setItem('darkMode', 'system'),
      toggleDarkMode() {
        this.darkMode = this.darkMode === 'dark' ? 'light' : 'dark';
      }
    }"
    @toggle-darkmode.window="toggleDarkMode()"
    x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))"
    x-bind:class="{'dark': darkMode === 'dark' || (darkMode === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)}"
>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/fontawesome-free-7.1.0-web/css/all.css'])
    @livewireStyles
</head>
<body x-data x-cloak class="min-h-svh flex w-full bg-background">
<div class="relative z-20 group peer text-sidebar-foreground isolate">
    {{--            <x-app-sidebar />--}}
    <x-app-sidebar />
</div>
<main class="flex-1 w-full flex flex-col">
    <header class="flex h-16 px-4 border-b border-border shrink-0 items-center gap-2 transition-[width,height] ease-linear">
        <x-button
            aria-expanded="false"
            aria-label="sidebar toggle button"
            aria-controls="sidebar-menu"
            class="me-2"
            variant="outline"
            size="icon"
            x-on:click="$dispatch('toggle-sidebar');"
        >
            <i class="fa-solid fa-table-columns"></i>
        </x-button>

        @if(isset($breadcrumbs))
            {{ $breadcrumbs }}
        @endif
    </header>
    <main class="flex-1 flex flex-col">
        {{ $slot }}
    </main>
</main>

<livewire:modal />
@livewireScripts
</body>
</html>
