@extends('layouts.admin')

@section('title', 'Sous-chapitres')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('admin.sous-chapitres.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
            + Nouveau Sous-chapitre
        </a>

        <div class="flex gap-2">
            <form method="GET" action="{{ route('admin.sous-chapitres.index') }}" class="flex gap-2">
                <select name="chapitre_id" onchange="this.form.submit()"
                        class="border border-gray-300 rounded-lg px-4 py-2">
                    <option value="">Tous les chapitres</option>
                    @foreach($chapitres as $chapitre)
                        <option value="{{ $chapitre->id }}"
                                {{ request('chapitre_id') == $chapitre->id ? 'selected' : '' }}>
                            {{ $chapitre->formation->nom }} — {{ $chapitre->titre }}
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

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">Titre</th>
                    <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">Chapitre</th>
                    <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">Formation</th>
                    <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">Contenu</th>
                    <th class="text-right px-6 py-4 text-sm font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($sousChapitres as $sousChapitre)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.sous-chapitres.show', $sousChapitre) }}"
                               class="text-blue-600 hover:underline font-medium">
                                {{ $sousChapitre->titre }}
                            </a>
                        </td>
                        <td class="px-6 py-4 text-gray-600">{{ $sousChapitre->chapitre->titre }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $sousChapitre->chapitre->formation->nom }}</td>
                        <td class="px-6 py-4">
                            @if($sousChapitre->contenu)
                                <span class="text-green-600 text-sm">✅ Rédigé</span>
                            @else
                                <span class="text-gray-400 text-sm">⏳ À rédiger</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.sous-chapitres.edit', $sousChapitre) }}"
                               class="text-yellow-600 hover:text-yellow-800 text-sm">✏️ Modifier</a>

                            <form method="POST"
                                  action="{{ route('admin.sous-chapitres.destroy', $sousChapitre) }}"
                                  class="inline"
                                  onsubmit="return confirm('Supprimer ce sous-chapitre ?')">
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
                            Aucun sous-chapitre trouvé.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $sousChapitres->withQueryString()->links() }}
    </div>
@endsection