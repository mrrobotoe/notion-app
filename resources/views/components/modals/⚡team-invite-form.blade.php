<?php

use App\Mail\TeamInvitation;
use Livewire\Component;

new class extends Component {
    #[\Livewire\Attributes\Validate('required')]
    public $email = '';

    public function sendInvite()
    {
        $team = auth()->user()->currentTeam;

        auth()->user()->can('invite-to-team', auth()->user()->currentTeam);

        $this->validate();

        $invite = $team->invites()->create([
            'email' => $this->email,
            'token' => str()->random(30)
        ]);

        Mail::to($this->email)->send(new TeamInvitation($invite));

        $this->dispatch("team-invites-updated");

        return back()->withStatus('team-invited');
    }
};
?>

<form
    x-data
    x-trap="show"
    class="flex flex-col p-4 w-full text-foreground"
    wire:submit="sendInvite"
    method="POST"
{{--    action="{{ route('team.invites.store', auth()->user()->currentTeam) }}"--}}
>
    @csrf
    <div class="flex items-center justify-between">
        <h2 class="text-lg tracking-tight">Invite new member</h2>
        <x-button size="icon" variant="ghost" wire:click="$dispatch('close-modal')">
            <i class="fas fa-times"></i>
        </x-button>
    </div>

    <div class="mt-4 flex flex-col space-y-2">
        <label for="email" class="text-sm">Email</label>
        <x-forms.input name="email" type="email" placeholder="email@example.com" wire:model="email"/>
        @error('email') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
        <x-button type="submit" class="mt-2">
            Send Invite
        </x-button>
        @if (session('status') === 'team-invited')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-muted-foreground"
            >{{ __('Invite sent.') }}</p>
        @endif
    </div>
</form>
