@extends('layouts.apprenant')

@section('title', $formation->nom)

@section('content')
    <a href="{{ route('apprenant.formations.index') }}"
       class="text-gray-500 hover:text-emerald-600 mb-4 inline-block">← Retour aux formations</a>

    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <h1 class="text-2xl font-bold text-gray-800">{{ $formation->nom }}</h1>
        <p class="text-gray-600 mt-2">{{ $formation->description }}</p>
    </div>

    @foreach($formation->chapitres as $chapitre)
        <div class="bg-white rounded-xl shadow-sm p-6 mb-4">
            <h2 class="text-lg font-semibold text-gray-800 mb-3">
                {{ $loop->iteration }}. {{ $chapitre->titre }}
            </h2>
            @if($chapitre->description)
                <p class="text-gray-500 text-sm mb-3">{{ $chapitre->description }}</p>
            @endif

            <div class="space-y-2 ml-4">
                @foreach($chapitre->sousChapitres as $sc)
                    <a href="{{ route('apprenant.sous-chapitres.show', $sc) }}"
                       class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-emerald-50 hover:border-emerald-300 transition">
                        <span class="text-emerald-600 mr-3">📄</span>
                        <span class="text-gray-700">{{ $sc->titre }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    @endforeach
@endsection