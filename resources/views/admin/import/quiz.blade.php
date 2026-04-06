@extends('layouts.admin')

@section('title', 'Importer un Quiz via IA')

@section('content')
    <div class="max-w-3xl">
        {{-- Fil d'ariane --}}
        <div class="mb-4 text-sm text-gray-500">
            <a href="{{ route('admin.formations.index') }}" class="hover:text-blue-600">Formations</a>
            <span class="mx-2">›</span>
            <a href="{{ route('admin.formations.show', $sousChapitre->chapitre->formation) }}" class="hover:text-blue-600">
                {{ $sousChapitre->chapitre->formation->nom }}
            </a>
            <span class="mx-2">›</span>
            <a href="{{ route('admin.sous-chapitres.show', $sousChapitre) }}" class="hover:text-blue-600">
                {{ $sousChapitre->titre }}
            </a>
            <span class="mx-2">›</span>
            <span class="text-gray-800">Import Quiz IA</span>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">
                🤖 Importer un quiz généré par IA
            </h3>
            <p class="text-gray-500 text-sm mb-4">
                Collez un quiz généré par ChatGPT. Le système détecte automatiquement les questions et réponses.
            </p>

            {{-- Format attendu --}}
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                <h4 class="font-medium text-blue-800 mb-2">📋 Format attendu :</h4>
                <pre class="text-blue-700 text-sm bg-blue-100 rounded p-3 overflow-x-auto">1. Quel est le prétérit de "go" ?
a. goed
*b. went
c. gone
d. gos

2. Quel est le participe passé de "see" ?
a. saw
b. seed
*c. seen
d. seeing</pre>
                <p class="text-blue-600 text-xs mt-2">
                    La bonne réponse est marquée avec un <strong>*</strong> devant la lettre.
                </p>
            </div>

            {{-- Exemple de prompt --}}
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-6">
                <h4 class="font-medium text-gray-700 mb-2">💡 Prompt à utiliser dans ChatGPT :</h4>
                <p class="text-gray-600 text-sm italic">
                    "Génère un quiz de 10 questions à choix multiples sur le thème '{{ $sousChapitre->titre }}'.
                    Chaque question a 4 réponses (a, b, c, d). Marque la bonne réponse avec un * devant la lettre.
                    Format : numéro de question suivi d'un point, puis les réponses sur les lignes suivantes."
                </p>
            </div>

            @if($sousChapitre->quiz)
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                    <p class="text-yellow-800 text-sm">
                        ⚠️ Un quiz existe déjà pour ce sous-chapitre ({{ $sousChapitre->quiz->titre }}).
                        Les nouvelles questions seront <strong>ajoutées</strong> au quiz existant.
                    </p>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.import.storeQuiz', $sousChapitre) }}">
                @csrf

                {{-- Titre --}}
                <div class="mb-4">
                    <label for="titre" class="block text-sm font-medium text-gray-700 mb-1">
                        Titre du quiz *
                    </label>
                    <input type="text"
                           name="titre"
                           id="titre"
                           value="{{ old('titre', $sousChapitre->quiz?->titre ?? 'Quiz : ' . $sousChapitre->titre) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                  @error('titre') border-red-500 @enderror">
                    @error('titre')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Contenu du quiz --}}
                <div class="mb-6">
                    <label for="quiz_text" class="block text-sm font-medium text-gray-700 mb-1">
                        Contenu du quiz *
                    </label>
                    <textarea name="quiz_text"
                              id="quiz_text"
                              rows="20"
                              placeholder="Collez ici le quiz généré par l'IA..."
                              class="w-full border border-gray-300 rounded-lg px-4 py-3 font-mono text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                     @error('quiz_text') border-red-500 @enderror">{{ old('quiz_text') }}</textarea>
                    @error('quiz_text')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Boutons --}}
                <div class="flex gap-3">
                    <button type="submit"
                            class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg transition">
                        🤖 Importer le quiz
                    </button>
                    <a href="{{ route('admin.sous-chapitres.show', $sousChapitre) }}"
                       class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg transition">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection