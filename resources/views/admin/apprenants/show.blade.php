@extends('layouts.admin')

@section('title', $apprenant->prenom . ' ' . $apprenant->nom)

@section('content')
    <a href="{{ route('admin.apprenants.index') }}"
       class="text-gray-500 hover:text-gray-700 mb-4 inline-block">
        ← Retour aux apprenants
    </a>

    {{-- Infos apprenant --}}
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <div class="flex justify-between items-start">
            <div>
                <h3 class="text-xl font-bold text-gray-800">
                    {{ $apprenant->prenom }} {{ $apprenant->nom }}
                </h3>
                <p class="text-gray-500 mt-1">{{ $apprenant->email }}</p>
                <p class="text-gray-400 text-sm mt-1">
                    Inscrit le {{ $apprenant->created_at->format('d/m/Y') }}
                </p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.apprenants.enrollments', $apprenant) }}"
                   class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm transition">
                    📚 Gérer les inscriptions
                </a>
                <a href="{{ route('admin.apprenants.edit', $apprenant) }}"
                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm transition">
                    ✏️ Modifier
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Formations inscrites --}}
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h4 class="text-lg font-semibold text-gray-800 mb-4">
                Formations ({{ $apprenant->formations->count() }})
            </h4>
            @forelse($apprenant->formations as $formation)
                <div class="border border-gray-200 rounded-lg p-3 mb-2">
                    <a href="{{ route('admin.formations.show', $formation) }}"
                       class="text-blue-600 hover:underline font-medium">
                        {{ $formation->nom }}
                    </a>
                    <span class="text-gray-400 text-xs ml-2">{{ ucfirst($formation->niveau) }}</span>
                </div>
            @empty
                <p class="text-gray-400">Aucune formation inscrite.</p>
            @endforelse
        </div>

        {{-- Notes --}}
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h4 class="text-lg font-semibold text-gray-800 mb-4">
                Notes ({{ $apprenant->notes->count() }})
            </h4>
            @forelse($apprenant->notes as $note)
                <div class="border border-gray-200 rounded-lg p-3 mb-2 flex justify-between items-center">
                    <span class="text-gray-700">{{ $note->formation->nom }}</span>
                    <span class="font-bold text-lg
                        {{ $note->note >= 10 ? 'text-green-600' : 'text-red-600' }}">
                        {{ $note->note }}/20
                    </span>
                </div>
            @empty
                <p class="text-gray-400">Aucune note.</p>
            @endforelse
        </div>
    </div>

    {{-- Résultats Quiz --}}
    <div class="bg-white rounded-xl shadow-sm p-6 mt-6">
        <h4 class="text-lg font-semibold text-gray-800 mb-4">
            Résultats Quiz ({{ $apprenant->quizResults->count() }})
        </h4>
        @forelse($apprenant->quizResults as $result)
            <div class="border border-gray-200 rounded-lg p-3 mb-2 flex justify-between items-center">
                <div>
                    <span class="text-gray-700 font-medium">{{ $result->quiz->titre }}</span>
                    <span class="text-gray-400 text-sm ml-2">
                        {{ $result->completed_at ? $result->completed_at->format('d/m/Y H:i') : '' }}
                    </span>
                </div>
                <span class="font-bold text-lg
                    {{ $result->pourcentage() >= 50 ? 'text-green-600' : 'text-red-600' }}">
                    {{ $result->score }}/{{ $result->total }}
                    ({{ $result->pourcentage() }}%)
                </span>
            </div>
        @empty
            <p class="text-gray-400">Aucun quiz passé.</p>
        @endforelse
    </div>
@endsection