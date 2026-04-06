@extends('layouts.admin')

@section('title', 'Nouvelle Question — ' . $quiz->titre)

@section('content')
    <div class="max-w-2xl">
        <a href="{{ route('admin.quiz.show', $quiz) }}"
           class="text-gray-500 hover:text-gray-700 mb-4 inline-block">
            ← Retour au quiz
        </a>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                Ajouter une question à : {{ $quiz->titre }}
            </h3>

            <form method="POST" action="{{ route('admin.questions.store', $quiz) }}">
                @csrf

                {{-- Question --}}
                <div class="mb-6">
                    <label for="texte" class="block text-sm font-medium text-gray-700 mb-1">
                        Question *
                    </label>
                    <textarea name="texte" id="texte" rows="3"
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                     @error('texte') border-red-500 @enderror">{{ old('texte') }}</textarea>
                    @error('texte')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Réponses --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-3">
                        Réponses * <span class="text-gray-400">(sélectionnez la bonne réponse)</span>
                    </label>

                    @for($i = 0; $i < 4; $i++)
                        <div class="flex items-center gap-3 mb-3">
                            <input type="radio"
                                   name="bonne_reponse"
                                   value="{{ $i }}"
                                   {{ old('bonne_reponse') == $i ? 'checked' : '' }}
                                   class="w-5 h-5 text-green-600 focus:ring-green-500">
                            <input type="text"
                                   name="reponses[{{ $i }}]"
                                   value="{{ old('reponses.' . $i) }}"
                                   placeholder="Réponse {{ $i + 1 }}"
                                   class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                          @error('reponses.' . $i) border-red-500 @enderror">
                        </div>
                    @endfor

                    @error('reponses')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    @error('bonne_reponse')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                        Ajouter la question
                    </button>
                    <a href="{{ route('admin.quiz.show', $quiz) }}"
                       class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg transition">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection