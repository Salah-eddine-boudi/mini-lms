@extends('layouts.admin')

@section('title', 'Quiz')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('admin.quiz.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
            + Nouveau Quiz
        </a>

        <form method="GET" action="{{ route('admin.quiz.index') }}" class="flex gap-2">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Rechercher un quiz..."
                   class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <button type="submit"
                    class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-lg transition">
                🔍
            </button>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">Titre</th>
                    <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">Sous-chapitre</th>
                    <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">Formation</th>
                    <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">Questions</th>
                    <th class="text-right px-6 py-4 text-sm font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($quizzes as $quiz)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.quiz.show', $quiz) }}"
                               class="text-blue-600 hover:underline font-medium">
                                {{ $quiz->titre }}
                            </a>
                        </td>
                        <td class="px-6 py-4 text-gray-600">{{ $quiz->sousChapitre->titre }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $quiz->sousChapitre->chapitre->formation->nom }}</td>
                        <td class="px-6 py-4">
                            <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full text-xs font-medium">
                                {{ $quiz->questions_count }} question(s)
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.quiz.show', $quiz) }}"
                               class="text-blue-600 hover:text-blue-800 text-sm">👁️ Voir</a>
                            <a href="{{ route('admin.quiz.edit', $quiz) }}"
                               class="text-yellow-600 hover:text-yellow-800 text-sm">✏️ Modifier</a>
                            <form method="POST"
                                  action="{{ route('admin.quiz.destroy', $quiz) }}"
                                  class="inline"
                                  onsubmit="return confirm('Supprimer ce quiz et toutes ses questions ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                                    🗑️ Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-400">
                            Aucun quiz trouvé.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $quizzes->withQueryString()->links() }}
    </div>
@endsection