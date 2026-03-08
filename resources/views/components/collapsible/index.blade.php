<div
    :id="$id('collapse')"
    class="w-full"
    x-data="{ expanded: $persist(false).as($id('collapse'))}"
>
    {{ $trigger }}

    <div x-show="expanded" x-collapse.duration.0ms {{ $attributes->merge(['class' => 'flex flex-col space-y-2']) }}>{{ $content }}</div>
</div>
