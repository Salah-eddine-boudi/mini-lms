@extends('layouts.admin')

@section('title', 'Modifier : ' . $quiz->titre)

@section('content')
    <div class="max-w-2xl">
        <a href="{{ route('admin.quiz.show', $quiz) }}"
           class="text-gray-500 hover:text-gray-700 mb-4 inline-block">
            ← Retour au quiz
        </a>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <form method="POST" action="{{ route('admin.quiz.update', $quiz) }}">
                @csrf
                @method('PUT')

                {{-- Sous-chapitre --}}
                <div class="mb-4">
                    <label for="sous_chapitre_id" class="block text-sm font-medium text-gray-700 mb-1">
                        Sous-chapitre *
                    </label>
                    <select name="sous_chapitre_id"
                            id="sous_chapitre_id"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                   @error('sous_chapitre_id') border-red-500 @enderror">
                        <option value="">-- Choisir un sous-chapitre --</option>
                        @foreach($sousChapitres as $sc)
                            <option value="{{ $sc->id }}"
                                    {{ old('sous_chapitre_id', $quiz->sous_chapitre_id) == $sc->id ? 'selected' : '' }}>
                                {{ $sc->chapitre->formation->nom }} › {{ $sc->chapitre->titre }} › {{ $sc->titre }}
                            </option>
                        @endforeach
                    </select>
                    @error('sous_chapitre_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Titre --}}
                <div class="mb-4">
                    <label for="titre" class="block text-sm font-medium text-gray-700 mb-1">
                        Titre du quiz *
                    </label>
                    <input type="text" name="titre" id="titre"
                           value="{{ old('titre', $quiz->titre) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                  @error('titre') border-red-500 @enderror">
                    @error('titre')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                        Description <span class="text-gray-400">(optionnel)</span>
                    </label>
                    <textarea name="description" id="description" rows="3"
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                     @error('description') border-red-500 @enderror">{{ old('description', $quiz->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                        Enregistrer les modifications
                    </button>
                    <a href="{{ route('admin.quiz.show', $quiz) }}"
                       class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg transition">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection