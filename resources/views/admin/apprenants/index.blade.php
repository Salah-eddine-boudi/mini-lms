@extends('layouts.admin')

@section('title', 'Apprenants')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('admin.apprenants.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
            + Nouvel Apprenant
        </a>

        <form method="GET" action="{{ route('admin.apprenants.index') }}" class="flex gap-2">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Rechercher nom, prénom, email..."
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
                    <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">Nom</th>
                    <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">Prénom</th>
                    <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">Email</th>
                    <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">Formations</th>
                    <th class="text-right px-6 py-4 text-sm font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($apprenants as $apprenant)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-800">{{ $apprenant->nom }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $apprenant->prenom }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $apprenant->email }}</td>
                        <td class="px-6 py-4">
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium">
                                {{ $apprenant->formations_count }} formation(s)
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.apprenants.show', $apprenant) }}"
                               class="text-blue-600 hover:text-blue-800 text-sm">👁️ Voir</a>

                            <a href="{{ route('admin.apprenants.enrollments', $apprenant) }}"
                               class="text-emerald-600 hover:text-emerald-800 text-sm">📚 Inscriptions</a>

                            <a href="{{ route('admin.apprenants.edit', $apprenant) }}"
                               class="text-yellow-600 hover:text-yellow-800 text-sm">✏️ Modifier</a>

                            <form method="POST"
                                  action="{{ route('admin.apprenants.destroy', $apprenant) }}"
                                  class="inline"
                                  onsubmit="return confirm('Supprimer cet apprenant ?')">
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
                            Aucun apprenant trouvé.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $apprenants->withQueryString()->links() }}
    </div>
@endsection