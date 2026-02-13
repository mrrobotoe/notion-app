<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Note extends Model
{
    /** @use HasFactory<\Database\Factories\NoteFactory> */
    use HasFactory;

    protected $fillable = [
        'title', 'content',
        'team_id',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public static function addNote(User $user, string $title, string|null $content)
    {
        return static::create([
            'title' => $title,
            'content' => $content,
            'user_id' => $user->id,
            'team_id' => $user->currentTeam->id
        ]);
    }

    public static function updateNote(Note $note, array $attributes)
    {
        $note->update($attributes);
        $note->save();
        return $note;
    }
}
