<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteDestroyRequest;
use App\Http\Requests\NoteStoreRequest;
use App\Http\Requests\NoteUpdateRequest;
use App\Models\Note;
use App\Models\Team;
use Illuminate\Http\RedirectResponse;

class NoteController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(NoteStoreRequest $request): RedirectResponse
    {
        Note::addNote(
            $request->user(),
            $request->validated()['title'],
            $request->validated()['content'] ?? null
        );

        return back()->withStatus('note-created');
    }

    public function edit()
    {

    }

    public function update(NoteUpdateRequest $request, Note $note): RedirectResponse
    {
        Note::updateNote($note, $request->validated());

        return back()->withStatus('note-updated');
    }

    public function destroy(NoteDestroyRequest $request, Team $team, Note $note): RedirectResponse
    {
        $note->delete();

        return back()->withStatus('note-deleted');
    }
}
