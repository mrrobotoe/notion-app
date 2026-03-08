<x-sidebar>
    <x-sidebar.header role="team switcher" class="relative">
        <x-dropdown class="flex w-full min-w-0 flex-col gap-1">
            <x-dropdown.trigger role="div">
                <x-sidebar.menu-button size="lg">
                    <div class="flex aspect-square size-8 items-center justify-center rounded-lg bg-sidebar text-sidebar-foreground">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-folder-kanban-icon lucide-folder-kanban size-4"><path d="M4 20h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.93a2 2 0 0 1-1.66-.9l-.82-1.2A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13c0 1.1.9 2 2 2Z"/><path d="M8 10v4"/><path d="M12 10v2"/><path d="M16 10v6"/></svg>
                    </div>

                    <div x-data class="grid flex-1 text-left text-sm leading-tight">
                          <span class="truncate font-medium dark:text-white">
                            {{ auth()->user()->currentTeam->name }}
                          </span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-auto lucide lucide-chevrons-up-down-icon lucide-chevrons-up-down"><path d="m7 15 5 5 5-5"/><path d="m7 9 5-5 5 5"/></svg>
                </x-sidebar.menu-button>
            </x-dropdown.trigger>
            <x-dropdown.content position="right-start">
                <x-dropdown.label>
                    Teams
                </x-dropdown.label>
                @foreach (auth()->user()->teams as $team)
                    <form action="{{ route('team.set-current', $team) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <x-dropdown.item type="button">
                            <div class="border border-border rounded-sm size-6 flex items-center justify-center me-1">
                                <i class="fa-solid fa-laptop-code"></i>
                            </div>
                            {{ $team->name }}
                        </x-dropdown.item>
                    </form>

                @endforeach
                <x-dropdown.separator />
                <a href="{{ route('settings') }}">
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
            <x-dropdown.content>
                <x-dropdown.label>
                    Menu
                </x-dropdown.label>
                <x-dropdown.item>
                    <i class="fa-solid fa-user me-1 font-light"></i>
                    Profile
                </x-dropdown.item>
                <a href="{{ route('settings') }}">
                    <x-dropdown.item>
                        <i class="fa-solid fa-cog me-1 font-light"></i>
                        Settings
                    </x-dropdown.item>
                </a>
                <a href="{{ route('settings.team') }}">
                    <x-dropdown.item>
                        <i class="fa-solid fa-people-group me-1 font-light"></i>
                        Team
                    </x-dropdown.item>
                </a>
                <x-dropdown.separator></x-dropdown.separator>
                <x-dropdown.label>
                    Appearance
                </x-dropdown.label>
                    <x-dropdown.item x-on:click="$dispatch('toggle-darkmode')">
                        <i class="fa-solid fa-palette me-1 font-light"></i>
                        <span x-text="(darkMode === 'dark' ? 'Light' : 'Dark')"></span>
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
