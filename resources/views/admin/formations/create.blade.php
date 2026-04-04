@extends('layouts.admin')

@section('title', 'Nouvelle Formation')

@section('content')
    <div class="max-w-2xl">
        <a href="{{ route('admin.formations.index') }}"
           class="text-gray-500 hover:text-gray-700 mb-4 inline-block">
            ← Retour aux formations
        </a>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <form method="POST" action="{{ route('admin.formations.store') }}">
                @csrf

                {{-- Nom --}}
                <div class="mb-4">
                    <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">
                        Nom de la formation *
                    </label>
                    <input type="text"
                           name="nom"
                           id="nom"
                           value="{{ old('nom') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                  @error('nom') border-red-500 @enderror">
                    @error('nom')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                        Description *
                    </label>
                    <textarea name="description"
                              id="description"
                              rows="4"
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                     @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Niveau --}}
                <div class="mb-4">
                    <label for="niveau" class="block text-sm font-medium text-gray-700 mb-1">
                        Niveau *
                    </label>
                    <select name="niveau"
                            id="niveau"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                   @error('niveau') border-red-500 @enderror">
                        <option value="">-- Choisir un niveau --</option>
                        <option value="débutant" {{ old('niveau') === 'débutant' ? 'selected' : '' }}>Débutant</option>
                        <option value="intermédiaire" {{ old('niveau') === 'intermédiaire' ? 'selected' : '' }}>Intermédiaire</option>
                        <option value="avancé" {{ old('niveau') === 'avancé' ? 'selected' : '' }}>Avancé</option>
                    </select>
                    @error('niveau')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Durée --}}
                <div class="mb-6">
                    <label for="duree" class="block text-sm font-medium text-gray-700 mb-1">
                        Durée <span class="text-gray-400">(optionnel)</span>
                    </label>
                    <input type="text"
                           name="duree"
                           id="duree"
                           value="{{ old('duree') }}"
                           placeholder="ex: 3 mois, 40 heures..."
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                  @error('duree') border-red-500 @enderror">
                    @error('duree')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Bouton --}}
                <div class="flex gap-3">
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                        Créer la formation
                    </button>
                    <a href="{{ route('admin.formations.index') }}"
                       class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg transition">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection