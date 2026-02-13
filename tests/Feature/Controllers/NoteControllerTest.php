<?php

use App\Models\User;
use function Pest\Laravel\actingAs;

it('can create a note', function() {
    $user = User::factory()->create();

    actingAs($user)
        ->post(route('notes.store'), ['title' => 'Test Note'])
        ->assertRedirect();

    expect(User::first()->notes)->toHaveCount(1)
        ->and(User::first()->notes->first()->title)->toBe('Test Note')
        ->and(User::first()->notes->first()->team_id)->toBe($user->currentTeam->id);
});

//it('cannot create a note without a title', function() {
//    $user = User::factory()->create();
//
//    actingAs($user)
//        ->post(route('notes.store', $user->currentTeam), ['content' => 'This is a test note.'])
//        ->assertSessionHasErrors('title');
//
//    expect(User::first()->notes)
//        ->toHaveCount(0)
//        ->and(User::first()->notes->first())->toBeNull();
//});

it('can update a note', function() {
    $user = User::factory()->create();

    $note = $user->notes()->create(['title' => 'Old Note', 'content' => 'Old content']);

    actingAs($user)
        ->put(route('notes.update',[$user->currentTeam, $note]), ['title' => 'New Note', 'content' => 'This is a test note.'])
        ->assertRedirect();

    expect(User::first()->notes->first()->title)->toBe('New Note');
});
//
//it('cannot update a note without a title', function() {
//    $user = User::factory()->create();
//    $note = $user->notes()->create(['title' => 'Old Note', 'content' => 'Old content', 'team_id' => $user->currentTeam->id]);
//
//    actingAs($user)
//        ->put(route('notes.update', $user->currentTeam, $note), ['content' => 'This is a test note.'])
//        ->assertSessionHasErrors('title');
//});
//
//it('cannot update a note that does not belong to the user team', function() {
//    $user = User::factory()->create();
//    $user->notes()->create(['title' => 'Old Note', 'content' => 'Old content']);
//    $anotherUser = User::factory()->create();
//    $note = $anotherUser->notes()->create(['title' => 'Old Note', 'content' => 'Old content', 'team_id' => $anotherUser->currentTeam->id]);
//
//    actingAs($user)
//        ->put(route('notes.update', $user->currentTeam, $note), ['title' => 'New Note', 'content' => 'This is a test note.'])
//        ->assertForbidden();
//
//    expect(User::first()->notes->first()->title)->not->toBe('New Note');
//});
//
//it('can delete a note', function() {
//    $user = User::factory()->create();
//    $note = $user->notes()->create(['title' => 'Test Note', 'content' => 'This is a test note.']);
//
//    expect(User::first()->notes)->toHaveCount(1);
//
//    actingAs($user)
//        ->delete(route('notes.destroy', $user->currentTeam, $note))
//        ->assertRedirect();
//
//    expect(User::first()->notes)->toHaveCount(0);
//});
