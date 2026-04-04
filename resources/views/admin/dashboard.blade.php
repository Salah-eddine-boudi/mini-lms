@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Card Formations --}}
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500">
            <p class="text-gray-500 text-sm">Formations</p>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['formations'] ?? 0 }}</p>
        </div>

        {{-- Card Apprenants --}}
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-emerald-500">
            <p class="text-gray-500 text-sm">Apprenants</p>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['apprenants'] ?? 0 }}</p>
        </div>

        {{-- Card Quiz --}}
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-purple-500">
            <p class="text-gray-500 text-sm">Quiz</p>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['quiz'] ?? 0 }}</p>
        </div>
    </div>

    <div class="mt-8 bg-white rounded-xl shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Bienvenue, {{ Auth::user()->prenom }} 👋</h3>
        <p class="text-gray-600">
            Utilisez le menu à gauche pour gérer les formations, chapitres, quiz, apprenants et notes.
        </p>
    </div>
@endsection