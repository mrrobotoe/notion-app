@props([
    'breadcrumbs'
])

 <x-breadcrumbs>
    <x-breadcrumbs.list>
        @foreach ($breadcrumbs as $breadcrumb)
            @if(request()->routeIs($breadcrumb->route))
                <x-breadcrumbs.page>
                    {{ $breadcrumb->title }}
                </x-breadcrumbs.page>
            @else
                <x-breadcrumbs.item>
                    {{ $breadcrumb->title }}
                </x-breadcrumbs.item>
            @endif

            @if (!$loop->last) <x-breadcrumbs.separator /> @endif
        @endforeach
    </x-breadcrumbs.list>
</x-breadcrumbs>
