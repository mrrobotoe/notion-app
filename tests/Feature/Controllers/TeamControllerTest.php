<?php

use App\Models\Team;
use App\Models\User;
use function Pest\Laravel\actingAs;

it('switches the current team for the user', function() {
    $user = User::factory()->create();

    $user->teams()->attach(
        $team = Team::factory()->create()
    );

    actingAs($user)
        ->patch(route('teams.set-current', $team))->assertRedirect();

    expect($user->currentTeam->id)->toBe($team->id);
});

it('cannot switch to a team that the user is not a member of', function() {
    $user = User::factory()->create();

    $anotherTeam = Team::factory()->create();

    actingAs($user)
        ->patch(route('teams.set-current', $anotherTeam))->assertForbidden();

    expect($user->currentTeam->id)->not->toBe($anotherTeam->id);
});
