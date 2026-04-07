<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — Mini LMS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-gray-900 text-white min-h-screen fixed left-0 top-0 flex flex-col">
        {{-- Logo --}}
        <div class="p-6 border-b border-gray-700">
            <h1 class="text-xl font-bold text-blue-400">Mini LMS</h1>
            <p class="text-gray-400 text-sm">Administration</p>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center px-4 py-3 rounded-lg transition
                      {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                <span class="mr-3">📊</span> Dashboard
            </a>

            <a href="{{ Route::has('admin.formations.index') ? route('admin.formations.index') : '#' }}"
               class="flex items-center px-4 py-3 rounded-lg transition
                      {{ request()->routeIs('admin.formations.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                <span class="mr-3">📚</span> Formations
            </a>

            <a href="{{ Route::has('admin.chapitres.index') ? route('admin.chapitres.index') : '#' }}"
               class="flex items-center px-4 py-3 rounded-lg transition
                      {{ request()->routeIs('admin.chapitres.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                <span class="mr-3">📖</span> Chapitres
            </a>

            <a href="{{ Route::has('admin.quiz.index') ? route('admin.quiz.index') : '#' }}"
               class="flex items-center px-4 py-3 rounded-lg transition
                      {{ request()->routeIs('admin.quiz.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                <span class="mr-3">❓</span> Quiz
            </a>

            <a href="{{ Route::has('admin.apprenants.index') ? route('admin.apprenants.index') : '#' }}"
               class="flex items-center px-4 py-3 rounded-lg transition
                      {{ request()->routeIs('admin.apprenants.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                <span class="mr-3">👥</span> Apprenants
            </a>

            <a href="{{ Route::has('admin.notes.index') ? route('admin.notes.index') : '#' }}"
               class="flex items-center px-4 py-3 rounded-lg transition
                      {{ request()->routeIs('admin.notes.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                <span class="mr-3">📝</span> Notes
            </a>
        </nav>

        {{-- Utilisateur --}}
        <div class="p-4 border-t border-gray-700">
            <p class="text-sm text-gray-400">Connecté :</p>
            <p class="text-white font-medium">{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</p>
            <button onclick="openLogoutModal()"
                    class="mt-2 text-red-400 hover:text-red-300 text-sm transition">
                🚪 Déconnexion
            </button>
        </div>
    </aside>

    {{-- CONTENU PRINCIPAL --}}
    <div class="ml-64 flex-1">
        {{-- Header --}}
        <header class="bg-white shadow-sm p-6">
            <h2 class="text-2xl font-bold text-gray-800">@yield('title', 'Dashboard')</h2>
        </header>

        {{-- Messages flash --}}
        @if(session('success'))
            <div class="mx-6 mt-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mx-6 mt-4 p-4 bg-red-100 border border-red-300 text-red-800 rounded-lg">
                ❌ {{ session('error') }}
            </div>
        @endif

        {{-- Contenu de la page --}}
        <main class="p-6">
            @yield('content')
        </main>
    </div>

     @include('components.logout-modal')

</body>
</html>