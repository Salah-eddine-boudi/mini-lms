@extends('layouts.admin')

@section('title', 'Nouvelle Note')

@section('content')
    <div class="max-w-2xl">
        <a href="{{ route('admin.notes.index') }}" class="text-gray-500 hover:text-gray-700 mb-4 inline-block">← Retour</a>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <form method="POST" action="{{ route('admin.notes.store') }}">
                @csrf

                <div class="mb-4">
                    <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">Apprenant *</label>
                    <select name="user_id" id="user_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 @error('user_id') border-red-500 @enderror">
                        <option value="">-- Choisir --</option>
                        @foreach($apprenants as $a)
                            <option value="{{ $a->id }}" {{ old('user_id') == $a->id ? 'selected' : '' }}>{{ $a->prenom }} {{ $a->nom }}</option>
                        @endforeach
                    </select>
                    @error('user_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="mb-4">
                    <label for="formation_id" class="block text-sm font-medium text-gray-700 mb-1">Formation *</label>
                    <select name="formation_id" id="formation_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 @error('formation_id') border-red-500 @enderror">
                        <option value="">-- Choisir --</option>
                        @foreach($formations as $f)
                            <option value="{{ $f->id }}" {{ old('formation_id') == $f->id ? 'selected' : '' }}>{{ $f->nom }}</option>
                        @endforeach
                    </select>
                    @error('formation_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="mb-4">
                    <label for="note" class="block text-sm font-medium text-gray-700 mb-1">Note /20 *</label>
                    <input type="number" name="note" id="note" value="{{ old('note') }}" min="0" max="20" step="0.25"
                           class="w-32 border border-gray-300 rounded-lg px-4 py-2 @error('note') border-red-500 @enderror">
                    @error('note')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="mb-6">
                    <label for="commentaire" class="block text-sm font-medium text-gray-700 mb-1">Commentaire</label>
                    <textarea name="commentaire" id="commentaire" rows="3"
                              class="w-full border border-gray-300 rounded-lg px-4 py-2">{{ old('commentaire') }}</textarea>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">Ajouter</button>
                    <a href="{{ route('admin.notes.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg transition">Annuler</a>
                </div>
            </form>
        </div>
    </div>
@endsection