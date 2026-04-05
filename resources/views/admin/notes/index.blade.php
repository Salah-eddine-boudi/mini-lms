@extends('layouts.admin')

@section('title', 'Notes')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('admin.notes.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
            + Nouvelle Note
        </a>
        <form method="GET" action="{{ route('admin.notes.index') }}" class="flex gap-2">
            <select name="formation_id" onchange="this.form.submit()" class="border border-gray-300 rounded-lg px-4 py-2">
                <option value="">Toutes les formations</option>
                @foreach($formations as $f)
                    <option value="{{ $f->id }}" {{ request('formation_id') == $f->id ? 'selected' : '' }}>{{ $f->nom }}</option>
                @endforeach
            </select>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">Apprenant</th>
                    <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">Formation</th>
                    <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">Note</th>
                    <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">Commentaire</th>
                    <th class="text-right px-6 py-4 text-sm font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($notes as $note)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $note->user->prenom }} {{ $note->user->nom }}</td>
                        <td class="px-6 py-4">{{ $note->formation->nom }}</td>
                        <td class="px-6 py-4">
                            <span class="font-bold {{ $note->note >= 10 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $note->note }}/20
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-500 text-sm">{{ Str::limit($note->commentaire, 50) ?? '—' }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.notes.edit', $note) }}" class="text-yellow-600 hover:text-yellow-800 text-sm">✏️</a>
                            <form method="POST" action="{{ route('admin.notes.destroy', $note) }}" class="inline" onsubmit="return confirm('Supprimer ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm">🗑️</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-6 py-8 text-center text-gray-400">Aucune note.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $notes->withQueryString()->links() }}</div>
@endsection