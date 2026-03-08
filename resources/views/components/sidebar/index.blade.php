<div
    class="group peer text-sidebar-foreground hidden md:block"
    :data-state="sidebarState"
    data-slot="sidebar"
    :data-collapsible="sidebarState === 'collapsed' ? 'icon' : ''"
    data-side="left"
>
    <div
        data-slot="sidebar-gap"
        class="relative w-(--sidebar-width) bg-transparent transition-[width] duration-200 ease-linear group-data-[collapsible=icon]:w-(--sidebar-width-icon)"
    >
    </div>
    <div
        data-slot="sidebar-container"
        class="fixed inset-y-0 z-10 hidden h-svh w-(--sidebar-width) transition-[left,right,width] duration-200 ease-linear md:flex left-0 group-data-[collapsible=offcanvas]:left-[calc(var(--sidebar-width)*-1)] group-data-[collapsible=icon]:w-(--sidebar-width-icon) group-data-[side=left]:border-r"
    >
        <div
            data-sidebar="sidebar"
            data-slot="sidebar-inner"
            class="bg-sidebar group-data-[variant=floating]:border-sidebar-border flex h-full w-full flex-col group-data-[variant=floating]:rounded-lg group-data-[variant=floating]:border group-data-[variant=floating]:shadow-sm"
        >
            {{ $slot }}
        </div>
    </div>
</div>
