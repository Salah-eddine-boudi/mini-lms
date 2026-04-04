@extends('layouts.admin')

@section('title', 'Inscriptions : ' . $apprenant->prenom . ' ' . $apprenant->nom)

@section('content')
    <div class="max-w-2xl">
        <a href="{{ route('admin.apprenants.show', $apprenant) }}"
           class="text-gray-500 hover:text-gray-700 mb-4 inline-block">
            ← Retour au profil
        </a>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                Inscrire {{ $apprenant->prenom }} {{ $apprenant->nom }} aux formations
            </h3>

            <form method="POST" action="{{ route('admin.apprenants.updateEnrollments', $apprenant) }}">
                @csrf
                @method('PUT')

                @forelse($formations as $formation)
                    <label class="flex items-center p-3 border border-gray-200 rounded-lg mb-2 cursor-pointer hover:bg-gray-50 transition">
                        <input type="checkbox"
                               name="formations[]"
                               value="{{ $formation->id }}"
                               {{ in_array($formation->id, $enrolledIds) ? 'checked' : '' }}
                               class="w-5 h-5 text-blue-600 rounded focus:ring-blue-500">
                        <div class="ml-3">
                            <span class="font-medium text-gray-800">{{ $formation->nom }}</span>
                            <span class="text-gray-400 text-sm ml-2">{{ ucfirst($formation->niveau) }}</span>
                        </div>
                    </label>
                @empty
                    <p class="text-gray-400">Aucune formation disponible.</p>
                @endforelse

                <div class="flex gap-3 mt-6">
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                        Enregistrer les inscriptions
                    </button>
                    <a href="{{ route('admin.apprenants.show', $apprenant) }}"
                       class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg transition">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection