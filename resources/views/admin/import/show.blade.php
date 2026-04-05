@extends('layouts.admin')

@section('title', 'Importer du contenu IA')

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
            <span class="text-gray-800">Import IA</span>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">
                🤖 Importer du contenu généré par IA
            </h3>
            <p class="text-gray-500 text-sm mb-4">
                Collez ici le contenu pédagogique généré par ChatGPT ou un autre outil d'IA. Le contenu peut être en HTML ou en texte simple.
            </p>

            {{-- Instructions --}}
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                <h4 class="font-medium text-blue-800 mb-2">💡 Comment faire ?</h4>
                <ol class="text-blue-700 text-sm space-y-1 list-decimal list-inside">
                    <li>Ouvrez ChatGPT ou un autre outil d'IA</li>
                    <li>Demandez-lui de générer un contenu pédagogique sur le thème souhaité</li>
                    <li>Précisez le format : "Génère le contenu en HTML avec des balises h2, h3, p, ul, li, table"</li>
                    <li>Copiez le résultat et collez-le dans le champ ci-dessous</li>
                </ol>
            </div>

            {{-- Exemple de prompt --}}
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-6">
                <h4 class="font-medium text-gray-700 mb-2">📋 Exemple de prompt à utiliser :</h4>
                <p class="text-gray-600 text-sm italic">
                    "Génère un contenu pédagogique en HTML sur le thème '{{ $sousChapitre->titre }}'. 
                    Utilise des balises h2, h3, p, ul, li et table pour structurer le contenu. 
                    Le texte doit être clair, simple et adapté à un niveau {{ $sousChapitre->chapitre->formation->niveau }}."
                </p>
            </div>

            <form method="POST" action="{{ route('admin.import.store', $sousChapitre) }}">
                @csrf

                {{-- Mode d'import --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Mode d'import</label>
                    <div class="flex gap-4">
                        <label class="flex items-center">
                            <input type="radio" name="mode" value="remplacer" checked
                                   class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-gray-700">Remplacer le contenu existant</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="mode" value="ajouter"
                                   class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-gray-700">Ajouter à la suite</span>
                        </label>
                    </div>
                </div>

                {{-- Contenu --}}
                <div class="mb-6">
                    <label for="contenu" class="block text-sm font-medium text-gray-700 mb-1">
                        Contenu à importer *
                    </label>
                    <textarea name="contenu"
                              id="contenu"
                              rows="15"
                              placeholder="Collez ici le contenu HTML ou texte généré par l'IA..."
                              class="w-full border border-gray-300 rounded-lg px-4 py-3 font-mono text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                     @error('contenu') border-red-500 @enderror">{{ old('contenu') }}</textarea>
                    @error('contenu')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Aperçu --}}
                <div class="mb-6">
                    <button type="button"
                            onclick="document.getElementById('preview').innerHTML = document.getElementById('contenu').value; document.getElementById('preview-box').classList.toggle('hidden');"
                            class="text-blue-600 hover:text-blue-800 text-sm underline">
                        👁️ Afficher / masquer l'aperçu
                    </button>
                    <div id="preview-box" class="hidden mt-3 border border-gray-200 rounded-lg p-4">
                        <p class="text-xs text-gray-400 mb-2">Aperçu du rendu :</p>
                        <div id="preview" class="prose max-w-none"></div>
                    </div>
                </div>

                {{-- Boutons --}}
                <div class="flex gap-3">
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                        🤖 Importer le contenu
                    </button>
                    <a href="{{ route('admin.sous-chapitres.show', $sousChapitre) }}"
                       class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg transition">
                        Annuler
                    </a>
                </div>
            </form>
        </div>

        {{-- Contenu actuel --}}
        @if($sousChapitre->contenu)
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h4 class="text-lg font-semibold text-gray-800 mb-4">Contenu actuel</h4>
                <div class="prose max-w-none border border-gray-200 rounded-lg p-4 bg-gray-50">
                    {!! $sousChapitre->contenu !!}
                </div>
            </div>
        @endif
    </div>
@endsection