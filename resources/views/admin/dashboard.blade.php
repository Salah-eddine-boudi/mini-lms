@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500">
            <p class="text-gray-500 text-sm">Formations</p>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['formations'] }}</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-emerald-500">
            <p class="text-gray-500 text-sm">Apprenants</p>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['apprenants'] }}</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-purple-500">
            <p class="text-gray-500 text-sm">Quiz</p>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['quiz'] }}</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-orange-500">
            <p class="text-gray-500 text-sm">Chapitres</p>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['chapitres'] }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Derniers apprenants --}}
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Derniers apprenants inscrits</h3>
            @forelse($dernierApprenants as $apprenant)
                <div class="flex justify-between items-center py-2 border-b border-gray-100 last:border-0">
                    <div>
                        <span class="font-medium text-gray-800">{{ $apprenant->prenom }} {{ $apprenant->nom }}</span>
                        <span class="text-gray-400 text-sm ml-2">{{ $apprenant->email }}</span>
                    </div>
                    <span class="text-gray-400 text-xs">{{ $apprenant->created_at->diffForHumans() }}</span>
                </div>
            @empty
                <p class="text-gray-400">Aucun apprenant.</p>
            @endforelse
        </div>

        {{-- Dernières notes --}}
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Dernières notes attribuées</h3>
            @forelse($dernieresNotes as $note)
                <div class="flex justify-between items-center py-2 border-b border-gray-100 last:border-0">
                    <div>
                        <span class="font-medium text-gray-800">{{ $note->user->prenom }} {{ $note->user->nom }}</span>
                        <span class="text-gray-400 text-sm ml-2">{{ $note->formation->nom }}</span>
                    </div>
                    <span class="font-bold {{ $note->note >= 10 ? 'text-green-600' : 'text-red-600' }}">
                        {{ $note->note }}/20
                    </span>
                </div>
            @empty
                <p class="text-gray-400">Aucune note.</p>
            @endforelse
        </div>
    </div>
@endsection