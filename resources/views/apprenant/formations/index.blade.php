@extends('layouts.apprenant')

@section('title', 'Mes Formations')

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Mes Formations</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($formations as $formation)
            <a href="{{ route('apprenant.formations.show', $formation->id) }}"
               class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition border-t-4 border-emerald-500">
                <h3 class="text-lg font-semibold text-gray-800">{{ $formation->nom }}</h3>
                <span class="inline-block mt-2 px-3 py-1 rounded-full text-xs font-medium
                    @if($formation->niveau === 'débutant') bg-green-100 text-green-800
                    @elseif($formation->niveau === 'intermédiaire') bg-yellow-100 text-yellow-800
                    @else bg-red-100 text-red-800
                    @endif">
                    {{ ucfirst($formation->niveau) }}
                </span>
                <p class="text-gray-500 text-sm mt-3">{{ Str::limit($formation->description, 100) }}</p>
                <p class="text-gray-400 text-xs mt-2">{{ $formation->chapitres->count() }} chapitre(s)</p>
            </a>
        @empty
            <div class="col-span-3 bg-white rounded-xl shadow-sm p-8 text-center">
                <p class="text-gray-400">Vous n'êtes inscrit à aucune formation.</p>
            </div>
        @endforelse
    </div>
@endsection