<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\User;
use App\Models\Formation;
use App\Http\Requests\Admin\StoreNoteRequest;
use App\Http\Requests\Admin\UpdateNoteRequest;

class NoteController extends Controller
{
    public function index()
    {
        $query = Note::with('user', 'formation');

        if (request('formation_id')) {
            $query->where('formation_id', request('formation_id'));
        }

        $notes = $query->latest()->paginate(10);
        $formations = Formation::orderBy('nom')->get();

        return view('admin.notes.index', compact('notes', 'formations'));
    }

    public function create()
    {
        $apprenants = User::where('role', 'apprenant')->orderBy('nom')->get();
        $formations = Formation::orderBy('nom')->get();
        return view('admin.notes.create', compact('apprenants', 'formations'));
    }

    public function store(StoreNoteRequest $request)
    {
        Note::create($request->validated());
        return redirect()->route('admin.notes.index')->with('success', 'Note ajoutée avec succès.');
    }

    public function edit(Note $note)
    {
        $apprenants = User::where('role', 'apprenant')->orderBy('nom')->get();
        $formations = Formation::orderBy('nom')->get();
        return view('admin.notes.edit', compact('note', 'apprenants', 'formations'));
    }

    public function update(UpdateNoteRequest $request, Note $note)
    {
        $note->update($request->validated());
        return redirect()->route('admin.notes.index')->with('success', 'Note modifiée avec succès.');
    }

    public function destroy(Note $note)
    {
        $note->delete();
        return redirect()->route('admin.notes.index')->with('success', 'Note supprimée avec succès.');
    }
}