<div
    x-data="{
        sidebarState: this.open ? 'expanded' : 'collapsed',
        open: true,
        isMobile: window.innerWidth < 768,
        SIDEBAR_KEYBOARD_SHORTCUT: 'b',
        toggleSidebar() {
            this.$dispatch('toggle-sidebar')
        },
        handleKeydown(event) {
            if (event.key === this.SIDEBAR_KEYBOARD_SHORTCUT && (event.metaKey || event.ctrlKey)) {
                event.preventDefault()
                this.toggleSidebar()
            }
        }
    }"
    x-init="
        isMobile = window.innerWidth < 768;
        $watch('open', value => sidebarState = (value ? 'expanded' : 'collapsed'));
        $watch('isMobile', value => sidebarState = value ? 'collapsed' : 'expanded');
    "
    @resize.window="isMobile = window.innerWidth < 768"
    @toggle-sidebar.window="open = ! open"
    @keydown.window="handleKeydown($event)"
    data-sidebar-wrapper
    :data-sidebar-state="sidebarState"
    style="
        --sidebar-width-icon: 3rem;
        --sidebar-width: 16rem;
    "
    class="group/sidebar-wrapper has-data-[variant=inset]:bg-sidebar flex min-h-svh w-full"
>
    {{ $slot }}
</div>
