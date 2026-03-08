<x-sidebar.header role="profile menu" class="relative">
    <x-dropdown class="flex w-full min-w-0 flex-col gap-1">
        <x-dropdown.trigger>
            <x-sidebar.menu-button size="lg">
                <x-avatar class="rounded-lg">
                    <x-avatar.image src="https://i.pravatar.cc/150?img=10" alt="adelle" />
                    <x-avatar.fallback>
                        {{ auth()->user()->getInitials() }}
                    </x-avatar.fallback>
                </x-avatar>

                <div x-data class="grid flex-1 text-left text-sm leading-tight">
                          <span class="truncate font-medium dark:text-white" wire:current-team-updated.window="$refresh">
                            {{ auth()->user()->name }}
                          </span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-auto lucide lucide-chevrons-up-down-icon lucide-chevrons-up-down"><path d="m7 15 5 5 5-5"/><path d="m7 9 5-5 5 5"/></svg>
            </x-sidebar.menu-button>
        </x-dropdown.trigger>

        <x-dropdown.content position="right" class="min-w-56!">
            <x-dropdown.label>
                Menu
            </x-dropdown.label>
            <x-dropdown.item>
                <i class="fa-solid fa-user me-1 font-light"></i>
                Profile
            </x-dropdown.item>
            <a href="{{ route('settings') }}" class="outline-0">
                <x-dropdown.item>
                    <i class="fa-solid fa-cog me-1 font-light"></i>
                    Settings
                </x-dropdown.item>
            </a>
            <a href="#" class="outline-0">
                <x-dropdown.item>
                    <i class="fa-solid fa-people-group me-1 font-light"></i>
                    Team
                </x-dropdown.item>
            </a>
            <x-dropdown.separator></x-dropdown.separator>
            <x-dropdown.label>
                Appearance
            </x-dropdown.label>
            <x-dropdown.item x-on:click.stop="" type="div" x-on:click="$dispatch('toggle-darkmode')">
                {{--                    <i class="fa-solid fa-palette me-1 font-light"></i>--}}
                <div class="inline-flex items-center gap-1" >

                    <div x-show="darkMode === 'dark'">
                        <i class="fa-solid fa-moon me-1 font-light text-neutral-600/90"></i>
                    </div>
                    <div x-show="darkMode === 'light'">
                        <i class="fa-solid fa-sun font-light me-1 text-neutral-600/90"></i>
                    </div>
                    <span x-text="(darkMode === 'dark' ? 'Dark Mode' : 'Light Mode')"></span>
                </div>

                <label class="inline-flex items-center cursor-pointer ms-auto">
                    <input type="checkbox" value="" class="sr-only peer" x-on:change="$dispatch('toggle-darkmode')" :checked="darkMode === 'dark'" tabindex="0">
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
</x-sidebar.header>
