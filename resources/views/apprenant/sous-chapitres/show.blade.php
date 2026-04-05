@extends('layouts.apprenant')

@section('title', $sousChapitre->titre)

@section('content')
    {{-- Fil d'ariane --}}
    <div class="mb-4 text-sm text-gray-500">
        <a href="{{ route('apprenant.formations.index') }}" class="hover:text-emerald-600">Mes Formations</a>
        <span class="mx-2">›</span>
        <a href="{{ route('apprenant.formations.show', $sousChapitre->chapitre->formation->id) }}" class="hover:text-emerald-600">
            {{ $sousChapitre->chapitre->formation->nom }}
        </a>
        <span class="mx-2">›</span>
        <span class="text-gray-800">{{ $sousChapitre->titre }}</span>
    </div>

    {{-- Contenu --}}
    <div class="bg-white rounded-xl shadow-sm p-8 mb-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">{{ $sousChapitre->titre }}</h1>
        @if($sousChapitre->contenu)
            <div class="prose max-w-none">{!! $sousChapitre->contenu !!}</div>
        @else
            <p class="text-gray-400">Contenu à venir.</p>
        @endif
    </div>

    {{-- Lien vers le quiz --}}
    @if($sousChapitre->quiz)
        <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-6 text-center">
            <h3 class="text-lg font-semibold text-emerald-800 mb-2">Quiz disponible !</h3>
            <p class="text-emerald-600 mb-4">Testez vos connaissances sur ce chapitre.</p>
            <a href="{{ route('apprenant.quiz.show', $sousChapitre->quiz) }}"
               class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-lg transition inline-block">
                🎯 Passer le quiz
            </a>
        </div>
    @endif
@endsection