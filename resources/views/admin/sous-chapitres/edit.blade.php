@extends('layouts.admin')

@section('title', 'Modifier : ' . $sousChapitre->titre)

@section('content')
    <div class="max-w-3xl">
        <a href="{{ route('admin.sous-chapitres.index', ['chapitre_id' => $sousChapitre->chapitre_id]) }}"
           class="text-gray-500 hover:text-gray-700 mb-4 inline-block">
            ← Retour aux sous-chapitres
        </a>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <form method="POST" action="{{ route('admin.sous-chapitres.update', $sousChapitre) }}">
                @csrf
                @method('PUT')

                {{-- Chapitre --}}
                <div class="mb-4">
                    <label for="chapitre_id" class="block text-sm font-medium text-gray-700 mb-1">
                        Chapitre *
                    </label>
                    <select name="chapitre_id"
                            id="chapitre_id"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                   @error('chapitre_id') border-red-500 @enderror">
                        <option value="">-- Choisir un chapitre --</option>
                        @foreach($chapitres as $chapitre)
                            <option value="{{ $chapitre->id }}"
                                    {{ old('chapitre_id', $sousChapitre->chapitre_id) == $chapitre->id ? 'selected' : '' }}>
                                {{ $chapitre->formation->nom }} — {{ $chapitre->titre }}
                            </option>
                        @endforeach
                    </select>
                    @error('chapitre_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Titre --}}
                <div class="mb-4">
                    <label for="titre" class="block text-sm font-medium text-gray-700 mb-1">
                        Titre du sous-chapitre *
                    </label>
                    <input type="text"
                           name="titre"
                           id="titre"
                           value="{{ old('titre', $sousChapitre->titre) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                  @error('titre') border-red-500 @enderror">
                    @error('titre')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Contenu --}}
                <div class="mb-4">
                    <label for="contenu" class="block text-sm font-medium text-gray-700 mb-1">
                        Contenu pédagogique <span class="text-gray-400">(HTML ou texte)</span>
                    </label>
                    <textarea name="contenu"
                              id="contenu"
                              rows="12"
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 font-mono text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                     @error('contenu') border-red-500 @enderror">{{ old('contenu', $sousChapitre->contenu) }}</textarea>
                    @error('contenu')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Ordre --}}
                <div class="mb-6">
                    <label for="ordre" class="block text-sm font-medium text-gray-700 mb-1">
                        Ordre d'affichage
                    </label>
                    <input type="number"
                           name="ordre"
                           id="ordre"
                           value="{{ old('ordre', $sousChapitre->ordre) }}"
                           min="0"
                           class="w-32 border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                {{-- Boutons --}}
                <div class="flex gap-3">
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                        Enregistrer les modifications
                    </button>
                    <a href="{{ route('admin.sous-chapitres.index', ['chapitre_id' => $sousChapitre->chapitre_id]) }}"
                       class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg transition">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection