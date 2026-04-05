@extends('layouts.admin')

@section('title', 'Nouvel Apprenant')

@section('content')
    <div class="max-w-2xl">
        <a href="{{ route('admin.apprenants.index') }}"
           class="text-gray-500 hover:text-gray-700 mb-4 inline-block">
            ← Retour aux apprenants
        </a>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <form method="POST" action="{{ route('admin.apprenants.store') }}">
                @csrf

                {{-- Nom --}}
                <div class="mb-4">
                    <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Nom *</label>
                    <input type="text" name="nom" id="nom" value="{{ old('nom') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                  @error('nom') border-red-500 @enderror">
                    @error('nom')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Prénom --}}
                <div class="mb-4">
                    <label for="prenom" class="block text-sm font-medium text-gray-700 mb-1">Prénom *</label>
                    <input type="text" name="prenom" id="prenom" value="{{ old('prenom') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                  @error('prenom') border-red-500 @enderror">
                    @error('prenom')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                  @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Mot de passe --}}
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe *</label>
                    <input type="password" name="password" id="password"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                  @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirmation mot de passe --}}
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                        Confirmer le mot de passe *
                    </label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                {{-- Boutons --}}
                <div class="flex gap-3">
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                        Créer l'apprenant
                    </button>
                    <a href="{{ route('admin.apprenants.index') }}"
                       class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg transition">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection