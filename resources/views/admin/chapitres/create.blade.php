@extends('layouts.admin')

@section('title', 'Nouveau Chapitre')

@section('content')
    <div class="max-w-2xl">
        <a href="{{ route('admin.chapitres.index') }}"
           class="text-gray-500 hover:text-gray-700 mb-4 inline-block">
            ← Retour aux chapitres
        </a>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <form method="POST" action="{{ route('admin.chapitres.store') }}">
                @csrf

                {{-- Formation --}}
                <div class="mb-4">
                    <label for="formation_id" class="block text-sm font-medium text-gray-700 mb-1">
                        Formation *
                    </label>
                    <select name="formation_id"
                            id="formation_id"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                   @error('formation_id') border-red-500 @enderror">
                        <option value="">-- Choisir une formation --</option>
                        @foreach($formations as $formation)
                            <option value="{{ $formation->id }}"
                                    {{ old('formation_id', $selectedFormation) == $formation->id ? 'selected' : '' }}>
                                {{ $formation->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('formation_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Titre --}}
                <div class="mb-4">
                    <label for="titre" class="block text-sm font-medium text-gray-700 mb-1">
                        Titre du chapitre *
                    </label>
                    <input type="text"
                           name="titre"
                           id="titre"
                           value="{{ old('titre') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                  @error('titre') border-red-500 @enderror">
                    @error('titre')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                        Description <span class="text-gray-400">(optionnel)</span>
                    </label>
                    <textarea name="description"
                              id="description"
                              rows="3"
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                     @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
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
                           value="{{ old('ordre', 0) }}"
                           min="0"
                           class="w-32 border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                  @error('ordre') border-red-500 @enderror">
                    @error('ordre')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Boutons --}}
                <div class="flex gap-3">
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                        Créer le chapitre
                    </button>
                    <a href="{{ route('admin.chapitres.index') }}"
                       class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg transition">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection