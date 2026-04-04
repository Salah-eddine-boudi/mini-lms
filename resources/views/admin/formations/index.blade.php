@extends('layouts.admin')

@section('title', 'Formations')

@section('content')
    {{-- En-tête avec bouton créer + recherche --}}
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('admin.formations.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
            + Nouvelle Formation
        </a>

        <form method="GET" action="{{ route('admin.formations.index') }}" class="flex gap-2">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Rechercher une formation..."
                   class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <button type="submit"
                    class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-lg transition">
                🔍
            </button>
        </form>
    </div>

    {{-- Tableau des formations --}}
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">Nom</th>
                    <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">Niveau</th>
                    <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">Durée</th>
                    <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">Chapitres</th>
                    <th class="text-right px-6 py-4 text-sm font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($formations as $formation)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.formations.show', $formation) }}"
                               class="text-blue-600 hover:underline font-medium">
                                {{ $formation->nom }}
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-medium
                                @if($formation->niveau === 'débutant') bg-green-100 text-green-800
                                @elseif($formation->niveau === 'intermédiaire') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($formation->niveau) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-600">{{ $formation->duree ?? '—' }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $formation->chapitres_count ?? 0 }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.formations.edit', $formation) }}"
                               class="text-yellow-600 hover:text-yellow-800 text-sm">✏️ Modifier</a>

                            <form method="POST"
                                  action="{{ route('admin.formations.destroy', $formation) }}"
                                  class="inline"
                                  onsubmit="return confirm('Supprimer cette formation ?')">
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
                            Aucune formation trouvée.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $formations->withQueryString()->links() }}
    </div>
@endsection