<?php

use Livewire\Component;

new class extends Component
{
    public array $navItems;

    public function mount(): void
    {
        $this->navItems = [
            (object) [
                'title' => 'Dashboard',
                'route' => 'dashboard',
                'icon' => 'fa-solid fa-rectangle-list',
                'items' => [
                    (object) [
                        'title' => 'My Issues',
                        'route' => 'dashboard'
                    ],
                    (object) [
                        'title' => 'All Issues',
                        'route' => 'dashboard'
                    ]
                ]
            ]
        ];
    }
};
?>

<x-sidebar>
    <x-sidebar.header role="team switcher" class="relative">
        <x-dropdown class="flex w-full min-w-0 flex-col gap-1">
            <x-dropdown.trigger>
                <x-sidebar.menu-button size="lg">
                    <div class="flex aspect-square size-8 items-center justify-center rounded-lg bg-sidebar text-sidebar-foreground">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-folder-kanban-icon lucide-folder-kanban size-4"><path d="M4 20h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.93a2 2 0 0 1-1.66-.9l-.82-1.2A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13c0 1.1.9 2 2 2Z"/><path d="M8 10v4"/><path d="M12 10v2"/><path d="M16 10v6"/></svg>
                    </div>

                    <div x-data class="grid flex-1 text-left text-sm leading-tight">
                          <span class="truncate font-medium dark:text-white" wire:current-team-updated.window="$refresh">
                            {{ auth()->user()->name }}
                          </span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-auto lucide lucide-chevrons-up-down-icon lucide-chevrons-up-down"><path d="m7 15 5 5 5-5"/><path d="m7 9 5-5 5 5"/></svg>
                </x-sidebar.menu-button>
            </x-dropdown.trigger>
            <x-dropdown.content position="right-start">
                <x-dropdown.label>
                    Teams
                </x-dropdown.label>
{{--                @foreach (auth()->user()->teams as $team)--}}
{{--                    <form action="{{ route('team.set-current', $team) }}" method="POST">--}}
{{--                        @csrf--}}
{{--                        @method('PATCH')--}}
{{--                        <x-dropdown.item type="button">--}}
{{--                            <div class="border border-border rounded-sm size-6 flex items-center justify-center me-1">--}}
{{--                                <i class="fa-solid fa-laptop-code"></i>--}}
{{--                            </div>--}}
{{--                            {{ $team->name }}--}}
{{--                        </x-dropdown.item>--}}
{{--                    </form>--}}

{{--                @endforeach--}}
                <x-dropdown.separator />
                <a href="#">
                    <x-dropdown.item>
                        <div class="border border-border rounded-sm size-6 flex items-center justify-center me-1">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                        Create Team
                    </x-dropdown.item>
                </a>
            </x-dropdown.content>
        </x-dropdown>
    </x-sidebar.header>
    <x-sidebar.content>
        <x-sidebar.group>
            <x-sidebar.group-label>
                Platform
            </x-sidebar.group-label>
            <x-sidebar.menu>

                @foreach ($navItems as $item)
                    <x-sidebar.menu-item>
                        <template x-if="isExpanded">
                            @if(@isset($item->items) && count($item->items) > 0)
                                <x-collapsible>
                                    <x-slot:trigger>
                                        <div x-on:mouseover="showTooltip = true" x-on:mouseleave="showTooltip = false" x-on:click="expanded = !expanded">
                                            <x-sidebar.menu-button
                                            >
                                                <i class="{{ $item->icon }}"></i>
                                                <span>{{ $item->title }}</span>
                                                <span class="ml-auto p-1 flex items-center justify-center text-sidebar-accent-foreground">
                                                    <i x-show="expanded" class="fa-solid fa-chevron-down" style="font-size: 0.8em"></i>
                                                    <i x-show="!expanded" class="fa-solid fa-chevron-right" style="font-size: 0.8em"></i>
                                                </span>
                                            </x-sidebar.menu-button>
                                        </div>
                                    </x-slot:trigger>
                                    <x-slot:content>
                                        @if(@isset($item->items))
                                            <x-sidebar.menu-sub>
                                                @foreach ($item->items as $subItem)
                                                    <x-sidebar.menu-sub-item>
                                                        <x-sidebar.menu-button>
                                                            {{ $subItem->title }}
                                                        </x-sidebar.menu-button>
                                                    </x-sidebar.menu-sub-item>
                                                @endforeach
                                            </x-sidebar.menu-sub>
                                        @endif
                                    </x-slot:content>
                                </x-collapsible>
                            @else
                                <x-sidebar.menu-button
                                >
                                    <i class="{{ $item->icon }}"></i>
                                    <span>{{ $item->title }}</span>
                                </x-sidebar.menu-button>
                            @endif
                        </template>

                        <template x-if="!isExpanded">
                            <x-tooltip>
                                <x-slot:trigger>
                                    <a href="{{ route($item->route) }}" x-on:mouseover="showTooltip = true" x-on:mouseleave="showTooltip = false">
                                        <x-sidebar.menu-button
                                            data-active="{{ request()->routeIs($item->route) ? 'true' : 'false' }}"
                                        >
                                            <i class="{{ $item->icon }}"></i>
                                            <span>{{ $item->title }}</span>
                                        </x-sidebar.menu-button>
                                    </a>
                                </x-slot:trigger>
                                <x-tooltip.content direction="right">
                                    {{ $item->title }}
                                </x-tooltip.content>
                            </x-tooltip>
                        </template>
                    </x-sidebar.menu-item>
                @endforeach
            </x-sidebar.menu>
        </x-sidebar.group>
    </x-sidebar.content>
    <x-sidebar.footer role="user profile menu">
        <x-dropdown class="flex w-full min-w-0 flex-col gap-1">
            <x-dropdown.trigger role="div">
                <x-sidebar.menu-button size="lg">
                    <x-avatar class="rounded-lg">
                        <x-avatar.image src="https://i.pravatar.cc/150?img=10" alt="adelle" />
                        <x-avatar.fallback>
                            {{ auth()->user()->getInitials() }}
                        </x-avatar.fallback>
                    </x-avatar>

                    <div class="grid flex-1 text-left text-sm leading-tight">
                        <span class="truncate font-medium dark:text-white">
                            {{ auth()->user()->name }}
                        </span>
                        <span class="text-xs truncate dark:text-neutral-400">
                            {{ auth()->user()->email }}
                        </span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-auto lucide lucide-chevrons-up-down-icon lucide-chevrons-up-down"><path d="m7 15 5 5 5-5"/><path d="m7 9 5-5 5 5"/></svg>
                </x-sidebar.menu-button>
            </x-dropdown.trigger>
            <x-dropdown.content position="right-end">
                <x-dropdown.label>
                    Menu
                </x-dropdown.label>
                <x-dropdown.item>
                    <i class="fa-solid fa-user me-1 font-light"></i>
                    Profile
                </x-dropdown.item>
                <a href="#">
                    <x-dropdown.item>
                        <i class="fa-solid fa-cog me-1 font-light"></i>
                        Settings
                    </x-dropdown.item>
                </a>
                <a href="#">
                    <x-dropdown.item>
                        <i class="fa-solid fa-people-group me-1 font-light"></i>
                        Team
                    </x-dropdown.item>
                </a>
                <x-dropdown.separator></x-dropdown.separator>
                <x-dropdown.label>
                    Appearance
                </x-dropdown.label>
                <x-dropdown.item x-on:click.stop="">
{{--                    <i class="fa-solid fa-palette me-1 font-light"></i>--}}
                    <a href="#" class="inline-flex items-center">
                        <div x-show="darkMode === 'dark'">
                            <svg class="w-4 h-4 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21a9 9 0 0 1-.5-17.986V3c-.354.966-.5 1.911-.5 3a9 9 0 0 0 9 9c.239 0 .254.018.488 0A9.004 9.004 0 0 1 12 21Z"/></svg>
                        </div>
                        <div x-show="darkMode !== 'dark'">
                            <svg class="w-4 h-4 me-1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill-rule="evenodd" d="M12 17.5a5.5 5.5 0 100-11 5.5 5.5 0 000 11zm0 1.5a7 7 0 100-14 7 7 0 000 14zm12-7a.75.75 0 01-.75.75h-2.5a.75.75 0 010-1.5h2.5A.75.75 0 0124 12zM4 12a.75.75 0 01-.75.75H.75a.75.75 0 010-1.5h2.5A.75.75 0 014 12zm16.485-8.485a.75.75 0 010 1.06l-1.768 1.768a.75.75 0 01-1.06-1.06l1.767-1.768a.75.75 0 011.061 0zM6.343 17.657a.75.75 0 010 1.06l-1.768 1.768a.75.75 0 11-1.06-1.06l1.767-1.768a.75.75 0 011.061 0zM12 0a.75.75 0 01.75.75v2.5a.75.75 0 01-1.5 0V.75A.75.75 0 0112 0zm0 20a.75.75 0 01.75.75v2.5a.75.75 0 01-1.5 0v-2.5A.75.75 0 0112 20zM3.515 3.515a.75.75 0 011.06 0l1.768 1.768a.75.75 0 11-1.06 1.06L3.515 4.575a.75.75 0 010-1.06zm14.142 14.142a.75.75 0 011.06 0l1.768 1.768a.75.75 0 01-1.06 1.06l-1.768-1.767a.75.75 0 010-1.061z"></path></g></svg>
                        </div>
                        <span x-text="(darkMode === 'dark' ? 'Dark Mode' : 'Light Mode')"></span>
                    </a>

                    <label class="inline-flex items-center cursor-pointer ms-auto">
                        <input type="checkbox" value="" class="sr-only peer" x-on:change="$dispatch('toggle-darkmode')" :checked="darkMode === 'dark'">
                        <div class="relative w-9 h-5 bg-input peer-focus:outline-none peer-focus:ring-1 peer-focus:ring-ring rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-buffer after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-brand"></div>
                        <span class="ms-3 text-sm font-medium text-heading sr-only">Toggle me</span>
                    </label>

                    {{--                    <span x-text="(darkMode === 'dark' ? 'Light' : 'Dark')"></span>--}}
                </x-dropdown.item>
                <x-dropdown.separator></x-dropdown.separator>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown.item role="button" type="submit">
                        <i class="fa-solid fa-arrow-right-from-bracket me-1 font-light"></i>
                        Log out
                    </x-dropdown.item>
                </form>
            </x-dropdown.content>
        </x-dropdown>
    </x-sidebar.footer>
</x-sidebar>
