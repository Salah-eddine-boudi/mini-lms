@extends('layouts.admin')

@section('title', $quiz->titre)

@section('content')
    {{-- Fil d'ariane --}}
    <div class="mb-4 text-sm text-gray-500">
        <a href="{{ route('admin.formations.index') }}" class="hover:text-blue-600">Formations</a>
        <span class="mx-2">›</span>
        <a href="{{ route('admin.formations.show', $quiz->sousChapitre->chapitre->formation) }}" class="hover:text-blue-600">
            {{ $quiz->sousChapitre->chapitre->formation->nom }}
        </a>
        <span class="mx-2">›</span>
        <a href="{{ route('admin.chapitres.show', $quiz->sousChapitre->chapitre) }}" class="hover:text-blue-600">
            {{ $quiz->sousChapitre->chapitre->titre }}
        </a>
        <span class="mx-2">›</span>
        <a href="{{ route('admin.sous-chapitres.show', $quiz->sousChapitre) }}" class="hover:text-blue-600">
            {{ $quiz->sousChapitre->titre }}
        </a>
        <span class="mx-2">›</span>
        <span class="text-gray-800">{{ $quiz->titre }}</span>
    </div>

    {{-- Détails du quiz --}}
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <div class="flex justify-between items-start">
            <div>
                <h3 class="text-xl font-bold text-gray-800">{{ $quiz->titre }}</h3>
                @if($quiz->description)
                    <p class="text-gray-600 mt-2">{{ $quiz->description }}</p>
                @endif
                <p class="text-gray-400 text-sm mt-2">
                    {{ $quiz->questions->count() }} question(s)
                </p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.questions.create', $quiz) }}"
                   class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm transition">
                    + Ajouter une question
                </a>
                <a href="{{ route('admin.quiz.edit', $quiz) }}"
                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm transition">
                    ✏️ Modifier
                </a>
            </div>
        </div>
    </div>

    {{-- Liste des questions --}}
    @forelse($quiz->questions as $question)
        <div class="bg-white rounded-xl shadow-sm p-6 mb-4">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <h4 class="font-semibold text-gray-800">
                        Question {{ $loop->iteration }} : {{ $question->texte }}
                    </h4>

                    <div class="mt-3 space-y-2">
                        @foreach($question->reponses as $reponse)
                            <div class="flex items-center p-2 rounded-lg
                                {{ $reponse->is_correct ? 'bg-green-50 border border-green-200' : 'bg-gray-50 border border-gray-200' }}">
                                @if($reponse->is_correct)
                                    <span class="text-green-600 mr-2">✅</span>
                                @else
                                    <span class="text-gray-400 mr-2">⭕</span>
                                @endif
                                <span class="{{ $reponse->is_correct ? 'text-green-800 font-medium' : 'text-gray-600' }}">
                                    {{ $reponse->texte }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex gap-2 ml-4">
                    <a href="{{ route('admin.questions.edit', $question) }}"
                       class="text-yellow-600 hover:text-yellow-800 text-sm">✏️</a>
                    <form method="POST"
                          action="{{ route('admin.questions.destroy', $question) }}"
                          class="inline"
                          onsubmit="return confirm('Supprimer cette question ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm">🗑️</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="bg-white rounded-xl shadow-sm p-8 text-center">
            <p class="text-gray-400 mb-4">Aucune question dans ce quiz.</p>
            <a href="{{ route('admin.questions.create', $quiz) }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                + Ajouter la première question
            </a>
        </div>
    @endforelse
@endsection