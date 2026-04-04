@extends('layouts.admin')

@section('title', $formation->nom)

@section('content')
    <a href="{{ route('admin.formations.index') }}"
       class="text-gray-500 hover:text-gray-700 mb-4 inline-block">
        ← Retour aux formations
    </a>

    {{-- Détails de la formation --}}
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <div class="flex justify-between items-start">
            <div>
                <h3 class="text-xl font-bold text-gray-800">{{ $formation->nom }}</h3>
                <span class="inline-block mt-2 px-3 py-1 rounded-full text-xs font-medium
                    @if($formation->niveau === 'débutant') bg-green-100 text-green-800
                    @elseif($formation->niveau === 'intermédiaire') bg-yellow-100 text-yellow-800
                    @else bg-red-100 text-red-800
                    @endif">
                    {{ ucfirst($formation->niveau) }}
                </span>
                @if($formation->duree)
                    <span class="ml-2 text-gray-500 text-sm">⏱️ {{ $formation->duree }}</span>
                @endif
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.formations.edit', $formation) }}"
                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm transition">
                    ✏️ Modifier
                </a>
            </div>
        </div>
        <p class="text-gray-600 mt-4">{{ $formation->description }}</p>
    </div>

    {{-- Liste des chapitres --}}
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800">
                Chapitres ({{ $formation->chapitres->count() }})
            </h3>
            @if(Route::has('admin.chapitres.create'))
                <a href="{{ route('admin.chapitres.create', ['formation_id' => $formation->id]) }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition">
                    + Ajouter un chapitre
                </a>
            @endif
        </div>

        @forelse($formation->chapitres as $chapitre)
            <div class="border border-gray-200 rounded-lg p-4 mb-3">
                <div class="flex justify-between items-center">
                    <div>
                        <h4 class="font-medium text-gray-800">
                            {{ $loop->iteration }}. {{ $chapitre->titre }}
                        </h4>
                        @if($chapitre->description)
                            <p class="text-gray-500 text-sm mt-1">{{ $chapitre->description }}</p>
                        @endif
                        <p class="text-gray-400 text-xs mt-1">
                            {{ $chapitre->sousChapitres->count() }} sous-chapitre(s)
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-400 text-center py-4">Aucun chapitre pour cette formation.</p>
        @endforelse
    </div>
@endsection