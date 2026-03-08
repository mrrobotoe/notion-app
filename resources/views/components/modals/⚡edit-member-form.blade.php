<?php

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

new class extends Component {
    public User $member;
    public int $memberId;

    public function mount(array $props)
    {
        $this->member = User::findOrFail($props['memberId']);
    }
};
?>

<form
    x-data
    x-trap="show"
    class="flex flex-col gap-4 p-2 w-full text-foreground"
    method="POST"
    action="{{ route('team.members.update', [auth()->user()->currentTeam, $this->member]) }}"
>
    @csrf
    <div class="flex items-center justify-between">
        <h2 class="text-lg tracking-tight">Edit member role ({{ $this->member->name }})</h2>
        <x-button size="icon" variant="ghost" wire:click="$dispatch('close-modal')">
            <i class="fas fa-times"></i>
        </x-button>
    </div>

    <div class="text-foreground flex flex-col gap-2">
{{--        <h4>{{ $this->member->name }}</h4>--}}
        <div class="flex gap-2">
            <div class="text-sm font-semibold">Role assigned: </div>
            <div class="flex flex-col gap-2">
                @foreach(Role::get() as $role)
                    <div class="inline-flex items-center">
                        <input
                            id="role-1"
                            type="radio"
                            value="{{ $role->name }}"
                            {{ strcmp($member->roles->pluck('name')->join(','),$role->name) == 0 ? 'checked' : '' }}
                            name="default-radio"
                            class="relative w-4 h-4 text-neutral-primary border-primary/80 bg-neutral-secondary-strong rounded-full checked:border-brand focus:ring-2 focus:outline-none focus:ring-brand-subtle border border-default appearance-none before:absolute grid place-items-center checked:before:left-1/5 checked:before:top-1/5 checked:before:inset-0 checked:before:w-2! checked:before:h-2! checked:before:rounded-full! checked:before:bg-primary!">
                        <label
                            for="role-1"
                            class="select-none ms-2 text-sm text-heading"
                        >
                            {{ ucfirst($role->name) }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <x-button class="ml-auto w-fit!">
        {{__('Save')}}
    </x-button>
</form>
