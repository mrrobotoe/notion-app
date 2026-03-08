<?php

use Livewire\Component;
use Livewire\Attributes\On;

new class extends Component
{
    public bool $open = false;

    public ?string $component = null;
    public array $props = [];
    public ?string $title = null;

    #[On('open-modal')]
    public function open(
        ?string $component = null,
        array $props = [],
        ?string $title = null,
    ): void
    {
        /**
         * JS dispatch → payload is populated
         * PHP dispatch → named args are populated
         */

        $this->component = $component;
        $this->props = $props;
        $this->title = $title;
        $this->open = true;
    }



    #[On('close-modal')]
    public function close(): void
    {
        $this->open = false;
    }

    public function resetModal(): void
    {
        $this->open = false;
        $this->component = null;
        $this->props = [];
        $this->title = null;
    }
};
?>

<div
    x-data="{
            show: $wire.entangle('open'),
            init() {
                this.$watch('$wire.open', value => {
                    this.show=!!value;
                })
            },
            close() {
                this.show = false
            }
        }"
    x-show="show"
    x-trap.noscroll.revert="show"
    @keydown.escape.window="close()"
    x-on:transitionend="if (!show) { $wire.resetModal(); $wire.open = false; }"
    x-cloak
    class="fixed inset-0 z-50 flex items-end sm:items-start justify-center p-6"
>
    {{-- Backdrop --}}
    <div
        class="absolute inset-0 bg-neutral-900/60 dark:bg-black/60"
        x-show="show"
        x-transition:enter="ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="close()"
        aria-hidden="true"
    ></div>

    {{-- Modal --}}
    <div
        x-show="show"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        class="relative bg-popover border border-border rounded-xl shadow-2xl w-full max-w-md overflow-hidden mt-24"
        role="dialog"
        aria-modal="true"
        aria-labelledby="modal-title"
    >
        {{-- Header --}}
{{--            <h2 id="modal-title" class="text-lg font-semibold text-neutral-900 dark:text-neutral-100">--}}
{{--                {{ $title }}--}}
{{--            </h2>--}}


        {{-- Content --}}
        <div class="relative flex items-center p-3">
            @if ($component)
                <livewire:dynamic-component
                    :component="$component"
                    :key="$component . md5(serialize($props))"
                    :$props
                />
            @endif
        </div>
    </div>
</div>
