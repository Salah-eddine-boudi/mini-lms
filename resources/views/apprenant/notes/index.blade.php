@extends('layouts.apprenant')

@section('title', 'Mes Notes')

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Mes Notes & Résultats</h1>

    {{-- Moyenne --}}
    @if($moyenne)
        <div class="bg-white rounded-xl shadow-sm p-6 mb-6 text-center">
            <p class="text-gray-500">Moyenne générale</p>
            <p class="text-4xl font-bold mt-2 {{ $moyenne >= 10 ? 'text-green-600' : 'text-red-600' }}">
                {{ $moyenne }}/20
            </p>
        </div>
    @endif

    {{-- Notes --}}
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Notes ({{ $notes->count() }})</h2>
        @forelse($notes as $note)
            <div class="flex justify-between items-center p-3 border border-gray-200 rounded-lg mb-2">
                <span class="text-gray-700">{{ $note->formation->nom }}</span>
                <div class="text-right">
                    <span class="font-bold text-lg {{ $note->note >= 10 ? 'text-green-600' : 'text-red-600' }}">
                        {{ $note->note }}/20
                    </span>
                    @if($note->commentaire)
                        <p class="text-gray-400 text-xs">{{ $note->commentaire }}</p>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-gray-400">Aucune note pour le moment.</p>
        @endforelse
    </div>

    {{-- Résultats Quiz --}}
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Résultats Quiz ({{ $quizResults->count() }})</h2>
        @forelse($quizResults as $result)
            <div class="flex justify-between items-center p-3 border border-gray-200 rounded-lg mb-2">
                <div>
                    <span class="text-gray-700 font-medium">{{ $result->quiz->titre }}</span>
                    <span class="text-gray-400 text-xs ml-2">{{ $result->completed_at?->format('d/m/Y H:i') }}</span>
                </div>
                <span class="font-bold {{ $result->pourcentage() >= 50 ? 'text-green-600' : 'text-red-600' }}">
                    {{ $result->score }}/{{ $result->total }} ({{ $result->pourcentage() }}%)
                </span>
            </div>
        @empty
            <p class="text-gray-400">Aucun quiz passé pour le moment.</p>
        @endforelse
    </div>
@endsection