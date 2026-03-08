<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div class="w-full">
    <header class="text-xl font-bold flex justify-between items-center">
        <h1>Header</h1>
        <div>
            <x-button
                variant="ghost"
                size="icon"
                @click="$dispatch('close-modal')"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                <span class="sr-only">Close</span>
            </x-button>
        </div>
    </header>
    <input name="email" type="email" >
</div>
