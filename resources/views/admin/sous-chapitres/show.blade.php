@extends('layouts.admin')

@section('title', $sousChapitre->titre)

@section('content')
    {{-- Fil d'ariane --}}
    <div class="mb-4 text-sm text-gray-500">
        <a href="{{ route('admin.formations.index') }}" class="hover:text-blue-600">Formations</a>
        <span class="mx-2">›</span>
        <a href="{{ route('admin.formations.show', $sousChapitre->chapitre->formation) }}" class="hover:text-blue-600">
            {{ $sousChapitre->chapitre->formation->nom }}
        </a>
        <span class="mx-2">›</span>
        <a href="{{ route('admin.chapitres.show', $sousChapitre->chapitre) }}" class="hover:text-blue-600">
            {{ $sousChapitre->chapitre->titre }}
        </a>
        <span class="mx-2">›</span>
        <span class="text-gray-800">{{ $sousChapitre->titre }}</span>
    </div>

    {{-- Détails --}}
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <div class="flex justify-between items-start">
            <h3 class="text-xl font-bold text-gray-800">{{ $sousChapitre->titre }}</h3>
            <div class="flex gap-2">
                <a href="{{ route('admin.import.show', $sousChapitre) }}"
                   class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded-lg text-sm transition">
                    🤖 Importer contenu IA
                </a>
                <a href="{{ route('admin.sous-chapitres.edit', $sousChapitre) }}"
                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm transition">
                    ✏️ Modifier
                </a>
            </div>
        </div>
    </div>

    {{-- Contenu pédagogique --}}
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <h4 class="text-lg font-semibold text-gray-800 mb-4">Contenu pédagogique</h4>
        @if($sousChapitre->contenu)
            <div class="prose max-w-none">
                {!! $sousChapitre->contenu !!}
            </div>
        @else
            <div class="text-center py-8">
                <p class="text-gray-400 mb-4">Aucun contenu pour le moment.</p>
                <a href="{{ route('admin.import.show', $sousChapitre) }}"
                   class="bg-purple-500 hover:bg-purple-600 text-white px-6 py-2 rounded-lg transition">
                    🤖 Importer du contenu via IA
                </a>
            </div>
        @endif
    </div>

    {{-- Quiz associé --}}
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex justify-between items-center mb-4">
            <h4 class="text-lg font-semibold text-gray-800">Quiz</h4>
            @if(!$sousChapitre->quiz && Route::has('admin.quiz.create'))
                <a href="{{ route('admin.quiz.create', ['sous_chapitre_id' => $sousChapitre->id]) }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition">
                    + Créer un quiz
                </a>
            @endif
        </div>

        @if($sousChapitre->quiz)
            <div class="border border-gray-200 rounded-lg p-4">
                <a href="{{ route('admin.quiz.show', $sousChapitre->quiz) }}" class="text-blue-600 hover:underline font-medium">
                    {{ $sousChapitre->quiz->titre }}
                </a>
                @if($sousChapitre->quiz->description)
                    <p class="text-gray-500 text-sm mt-1">{{ $sousChapitre->quiz->description }}</p>
                @endif
            </div>
        @else
            <p class="text-gray-400">Aucun quiz associé à ce sous-chapitre.</p>
        @endif
    </div>
@endsection