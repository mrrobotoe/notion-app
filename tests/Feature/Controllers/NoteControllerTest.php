<?php

use App\Models\User;
use function Pest\Laravel\actingAs;

it('can create a note', function() {
    $user = User::factory()->create();

    actingAs($user)
        ->post(route('notes.store'), ['title' => 'Test Note', 'content' => 'This is a test note.'])
        ->assertRedirect();

    expect(User::first()->notes)->toHaveCount(1)
        ->and(User::first()->notes->first()->title)->toBe('Test Note');
});

it('cannot create a note without a title', function() {
    $user = User::factory()->create();

    actingAs($user)
        ->post(route('notes.store'), ['content' => 'This is a test note.'])
        ->assertSessionHasErrors('title');

    expect(User::first()->notes)->toHaveCount(0);
});

it('can update a note', function() {
    $user = User::factory()->create();

    $note = $user->notes()->create(['title' => 'Old Note', 'content' => 'Old content']);

    actingAs($user)
        ->put(route('notes.update', $note), ['title' => 'New Note', 'content' => 'This is a test note.'])
        ->assertRedirect();

    expect(User::first()->notes->first()->title)->toBe('New Note');
});

it('cannot update a note without a title', function() {
    $user = User::factory()->create();
    $note = $user->notes()->create(['title' => 'Old Note', 'content' => 'Old content']);

    actingAs($user)
        ->put(route('notes.update', $note), ['content' => 'This is a test note.'])
        ->assertSessionHasErrors('title');
});

it('can delete a note', function() {
    $user = User::factory()->create();
    $note = $user->notes()->create(['title' => 'Test Note', 'content' => 'This is a test note.']);

    expect(User::first()->notes)->toHaveCount(1);

    actingAs($user)
        ->delete(route('notes.destroy', $note))
        ->assertRedirect();

    expect(User::first()->notes)->toHaveCount(0);
});
