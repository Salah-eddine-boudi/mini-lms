@extends('layouts.admin')

@section('title', $chapitre->titre)

@section('content')
    {{-- Fil d'ariane --}}
    <div class="mb-4 text-sm text-gray-500">
        <a href="{{ route('admin.formations.index') }}" class="hover:text-blue-600">Formations</a>
        <span class="mx-2">›</span>
        <a href="{{ route('admin.formations.show', $chapitre->formation) }}" class="hover:text-blue-600">
            {{ $chapitre->formation->nom }}
        </a>
        <span class="mx-2">›</span>
        <span class="text-gray-800">{{ $chapitre->titre }}</span>
    </div>

    {{-- Détails du chapitre --}}
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <div class="flex justify-between items-start">
            <div>
                <h3 class="text-xl font-bold text-gray-800">{{ $chapitre->titre }}</h3>
                @if($chapitre->description)
                    <p class="text-gray-600 mt-2">{{ $chapitre->description }}</p>
                @endif
                <p class="text-gray-400 text-sm mt-2">Ordre : {{ $chapitre->ordre }}</p>
            </div>
            <a href="{{ route('admin.chapitres.edit', $chapitre) }}"
               class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm transition">
                ✏️ Modifier
            </a>
        </div>
    </div>

    {{-- Liste des sous-chapitres --}}
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800">
                Sous-chapitres ({{ $chapitre->sousChapitres->count() }})
            </h3>
            <a href="{{ route('admin.sous-chapitres.create', ['chapitre_id' => $chapitre->id]) }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition">
                + Ajouter un sous-chapitre
            </a>
        </div>

        @forelse($chapitre->sousChapitres as $sousChapitre)
            <div class="border border-gray-200 rounded-lg p-4 mb-3">
                <div class="flex justify-between items-center">
                    <div>
                        <h4 class="font-medium text-gray-800">
                            <a href="{{ route('admin.sous-chapitres.show', $sousChapitre) }}"
                               class="hover:text-blue-600">
                                {{ $loop->iteration }}. {{ $sousChapitre->titre }}
                            </a>
                        </h4>
                        <p class="text-gray-400 text-xs mt-1">
                            {{ $sousChapitre->contenu ? Str::limit(strip_tags($sousChapitre->contenu), 100) : 'Pas de contenu' }}
                        </p>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.sous-chapitres.edit', $sousChapitre) }}"
                           class="text-yellow-600 hover:text-yellow-800 text-sm">✏️</a>
                        <form method="POST"
                              action="{{ route('admin.sous-chapitres.destroy', $sousChapitre) }}"
                              class="inline"
                              onsubmit="return confirm('Supprimer ce sous-chapitre ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm">🗑️</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-400 text-center py-4">Aucun sous-chapitre pour ce chapitre.</p>
        @endforelse
    </div>
@endsection