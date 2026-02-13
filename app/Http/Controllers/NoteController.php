<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteDestroyRequest;
use App\Http\Requests\NoteStoreRequest;
use App\Http\Requests\NoteUpdateRequest;
use App\Models\Note;
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
        $request->user()->notes()->create($request->validated());

        return back()->withStatus('note-created');
    }

    public function edit()
    {

    }

    public function update(NoteUpdateRequest $request, Note $note): RedirectResponse
    {
        $note->update($request->validated());

        return back()->withStatus('note-updated');
    }

    public function destroy(NoteDestroyRequest $note): RedirectResponse
    {
        $note->delete();

        return back()->withStatus('note-deleted');
    }
}
