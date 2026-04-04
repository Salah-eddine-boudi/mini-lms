@extends('layouts.apprenant')

@section('title', 'Mon Espace')

@section('content')
    <div class="bg-white rounded-xl shadow-sm p-8">
        <h1 class="text-2xl font-bold text-gray-800">
            Bonjour, {{ Auth::user()->prenom }} {{ Auth::user()->nom }} 👋
        </h1>
        <p class="text-gray-600 mt-2">
            Bienvenue sur votre espace d'apprentissage. Consultez vos formations et passez vos quiz.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
        <a href="{{ Route::has('apprenant.formations.index') ? route('apprenant.formations.index') : '#' }}"
           class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition border-t-4 border-emerald-500">
            <p class="text-lg font-semibold text-gray-800">📚 Mes Formations</p>
            <p class="text-gray-500 text-sm mt-2">Accéder à vos cours et contenus</p>
        </a>

        <a href="{{ Route::has('apprenant.notes.index') ? route('apprenant.notes.index') : '#' }}"
           class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition border-t-4 border-blue-500">
            <p class="text-lg font-semibold text-gray-800">📝 Mes Notes</p>
            <p class="text-gray-500 text-sm mt-2">Consulter vos résultats</p>
        </a>

        <a href="{{ Route::has('profile.edit') ? route('profile.edit') : '#' }}"
           class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition border-t-4 border-purple-500">
            <p class="text-lg font-semibold text-gray-800">👤 Mon Profil</p>
            <p class="text-gray-500 text-sm mt-2">Modifier vos informations</p>
        </a>
    </div>
@endsection