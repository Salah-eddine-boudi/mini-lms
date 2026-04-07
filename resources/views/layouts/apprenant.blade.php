<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Espace Apprenant') — Mini LMS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen">

    {{-- NAVBAR --}}
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            {{-- Logo --}}
            <a href="{{ route('apprenant.dashboard') }}" class="text-xl font-bold text-emerald-600">
                🎓 Mini LMS
            </a>

            {{-- Liens de navigation --}}
            <div class="flex items-center space-x-6">
                <a href="{{ route('apprenant.dashboard') }}"
                   class="transition {{ request()->routeIs('apprenant.dashboard') ? 'text-emerald-600 font-semibold' : 'text-gray-600 hover:text-emerald-600' }}">
                    Accueil
                </a>

                <a href="{{ Route::has('apprenant.formations.index') ? route('apprenant.formations.index') : '#' }}"
                   class="transition {{ request()->routeIs('apprenant.formations.*') ? 'text-emerald-600 font-semibold' : 'text-gray-600 hover:text-emerald-600' }}">
                    Mes Formations
                </a>

                <a href="{{ Route::has('apprenant.notes.index') ? route('apprenant.notes.index') : '#' }}"
                   class="transition {{ request()->routeIs('apprenant.notes.*') ? 'text-emerald-600 font-semibold' : 'text-gray-600 hover:text-emerald-600' }}">
                    Mes Notes
                </a>

                {{-- Profil et déconnexion --}}
                <div class="flex items-center space-x-4 ml-4 pl-4 border-l border-gray-200">
                    <a href="{{ Route::has('profile.edit') ? route('profile.edit') : '#' }}" class="text-gray-600 hover:text-emerald-600 transition">
                        👤 {{ Auth::user()->prenom }}
                    </a>
                    <button onclick="openLogoutModal()"
                            class="text-red-500 hover:text-red-400 text-sm transition">
                        Déconnexion
                    </button>
                </div>
            </div>
        </div>
    </nav>

    {{-- Messages flash --}}
    <div class="max-w-7xl mx-auto px-4">
        @if(session('success'))
            <div class="mt-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mt-4 p-4 bg-red-100 border border-red-300 text-red-800 rounded-lg">
                ❌ {{ session('error') }}
            </div>
        @endif
    </div>

    {{-- CONTENU --}}
    <main class="max-w-7xl mx-auto px-4 py-8">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-white border-t mt-12 py-6 text-center text-gray-400 text-sm">
        Mini LMS © {{ date('Y') }} — Plateforme pédagogique
    </footer>
              @include('components.logout-modal')
</body>
</html>