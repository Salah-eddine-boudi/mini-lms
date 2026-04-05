@extends('layouts.admin')

@section('title', 'Chapitres')

@section('content')
    {{-- En-tête --}}
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('admin.chapitres.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
            + Nouveau Chapitre
        </a>

        <div class="flex gap-2">
            {{-- Filtre par formation --}}
            <form method="GET" action="{{ route('admin.chapitres.index') }}" class="flex gap-2">
                <select name="formation_id" onchange="this.form.submit()"
                        class="border border-gray-300 rounded-lg px-4 py-2">
                    <option value="">Toutes les formations</option>
                    @foreach($formations as $formation)
                        <option value="{{ $formation->id }}"
                                {{ request('formation_id') == $formation->id ? 'selected' : '' }}>
                            {{ $formation->nom }}
                        </option>
                    @endforeach
                </select>

                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Rechercher..."
                       class="border border-gray-300 rounded-lg px-4 py-2">
                <button type="submit"
                        class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-lg transition">
                    🔍
                </button>
            </form>
        </div>
    </div>

    {{-- Tableau --}}
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">Ordre</th>
                    <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">Titre</th>
                    <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">Formation</th>
                    <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">Sous-chapitres</th>
                    <th class="text-right px-6 py-4 text-sm font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($chapitres as $chapitre)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-gray-500">{{ $chapitre->ordre }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.chapitres.show', $chapitre) }}"
                               class="text-blue-600 hover:underline font-medium">
                                {{ $chapitre->titre }}
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.formations.show', $chapitre->formation) }}"
                               class="text-gray-600 hover:text-blue-600">
                                {{ $chapitre->formation->nom }}
                            </a>
                        </td>
                        <td class="px-6 py-4 text-gray-600">{{ $chapitre->sous_chapitres_count }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.chapitres.edit', $chapitre) }}"
                               class="text-yellow-600 hover:text-yellow-800 text-sm">✏️ Modifier</a>

                            <form method="POST"
                                  action="{{ route('admin.chapitres.destroy', $chapitre) }}"
                                  class="inline"
                                  onsubmit="return confirm('Supprimer ce chapitre et tous ses sous-chapitres ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                                    🗑️ Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-400">
                            Aucun chapitre trouvé.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $chapitres->withQueryString()->links() }}
    </div>
@endsection