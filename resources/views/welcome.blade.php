<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini LMS — Plateforme Pédagogique</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen">

    {{-- Navbar --}}
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <span class="text-xl font-bold text-blue-600">🎓 Mini LMS</span>
            <div class="space-x-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                        Mon espace
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 transition">
                        Se connecter
                    </a>
                    <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                        S'inscrire
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Hero --}}
    <section class="max-w-7xl mx-auto px-4 py-20 text-center">
        <h1 class="text-5xl font-bold text-gray-800 mb-6">
            Apprenez à votre rythme
        </h1>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto mb-10">
            Mini LMS est une plateforme pédagogique qui vous permet d'accéder à des formations structurées, des contenus de cours et des quiz interactifs.
        </p>
        @guest
            <div class="space-x-4">
                <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg text-lg transition">
                    Commencer maintenant
                </a>
                <a href="{{ route('login') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-8 py-3 rounded-lg text-lg transition">
                    J'ai déjà un compte
                </a>
            </div>
        @endguest
    </section>

    {{-- Fonctionnalités --}}
    <section class="max-w-7xl mx-auto px-4 py-16">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-xl shadow-sm p-8 text-center">
                <div class="text-4xl mb-4">📚</div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Formations structurées</h3>
                <p class="text-gray-500">Des cours organisés en chapitres et sous-chapitres pour un apprentissage progressif.</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-8 text-center">
                <div class="text-4xl mb-4">🎯</div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Quiz interactifs</h3>
                <p class="text-gray-500">Testez vos connaissances avec des quiz à choix multiples et obtenez votre score instantanément.</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-8 text-center">
                <div class="text-4xl mb-4">📝</div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Suivi des résultats</h3>
                <p class="text-gray-500">Consultez vos notes et résultats de quiz pour suivre votre progression.</p>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-white border-t py-8 text-center text-gray-400 text-sm mt-12">
        Mini LMS © {{ date('Y') }} — Plateforme pédagogique | Développé en Laravel
    </footer>

</body>
</html>