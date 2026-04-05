@extends('layouts.apprenant')

@section('title', 'Résultat — ' . $quiz->titre)

@section('content')
    <div class="max-w-3xl mx-auto">
        {{-- Score --}}
        <div class="bg-white rounded-xl shadow-sm p-8 text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Résultat du quiz</h1>
            <div class="text-6xl font-bold mb-2
                {{ ($score / $total) >= 0.5 ? 'text-green-600' : 'text-red-600' }}">
                {{ $score }}/{{ $total }}
            </div>
            <p class="text-gray-500 text-lg">
                {{ round(($score / $total) * 100) }}% de bonnes réponses
            </p>
            @if(($score / $total) >= 0.5)
                <p class="text-green-600 font-semibold mt-2">Bravo ! Quiz réussi ! 🎉</p>
            @else
                <p class="text-red-600 font-semibold mt-2">Continuez à réviser ! 💪</p>
            @endif
        </div>

        {{-- Détails --}}
        @foreach($details as $index => $detail)
            <div class="bg-white rounded-xl shadow-sm p-6 mb-3
                {{ $detail['is_correct'] ? 'border-l-4 border-green-500' : 'border-l-4 border-red-500' }}">
                <h4 class="font-semibold text-gray-800 mb-2">{{ $index + 1 }}. {{ $detail['question'] }}</h4>
                <p class="text-sm">
                    <span class="text-gray-500">Votre réponse :</span>
                    <span class="{{ $detail['is_correct'] ? 'text-green-600' : 'text-red-600' }} font-medium">
                        {{ $detail['reponse_choisie'] }}
                        {{ $detail['is_correct'] ? '✅' : '❌' }}
                    </span>
                </p>
                @if(!$detail['is_correct'])
                    <p class="text-sm mt-1">
                        <span class="text-gray-500">Bonne réponse :</span>
                        <span class="text-green-600 font-medium">{{ $detail['bonne_reponse'] }}</span>
                    </p>
                @endif
            </div>
        @endforeach

        <div class="text-center mt-6">
            <a href="{{ route('apprenant.formations.index') }}"
               class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-lg transition">
                ← Retour aux formations
            </a>
        </div>
    </div>
@endsection