@extends('layouts.apprenant')

@section('title', $quiz->titre)

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
            <h1 class="text-2xl font-bold text-gray-800">{{ $quiz->titre }}</h1>
            @if($quiz->description)
                <p class="text-gray-600 mt-2">{{ $quiz->description }}</p>
            @endif
            <p class="text-gray-400 text-sm mt-2">{{ $quiz->questions->count() }} question(s)</p>
        </div>

        <form method="POST" action="{{ route('apprenant.quiz.submit', $quiz) }}">
            @csrf

            @foreach($quiz->questions as $question)
                <div class="bg-white rounded-xl shadow-sm p-6 mb-4">
                    <h3 class="font-semibold text-gray-800 mb-4">
                        {{ $loop->iteration }}. {{ $question->texte }}
                    </h3>

                    <div class="space-y-2">
                        @foreach($question->reponses as $reponse)
                            <label class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-emerald-50 hover:border-emerald-300 transition">
                                <input type="radio"
                                       name="question_{{ $question->id }}"
                                       value="{{ $reponse->id }}"
                                       class="w-5 h-5 text-emerald-600 focus:ring-emerald-500"
                                       required>
                                <span class="ml-3 text-gray-700">{{ $reponse->texte }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <div class="text-center mt-6">
                <button type="submit"
                        class="bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-3 rounded-lg text-lg transition"
                        onclick="return confirm('Soumettre vos réponses ?')">
                    ✅ Valider mes réponses
                </button>
            </div>
        </form>
    </div>
@endsection