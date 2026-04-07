<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini LMS — Plateforme Pédagogique</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .hero-pattern {
            background-image: radial-gradient(circle at 20% 50%, rgba(99, 102, 241, 0.1) 0%, transparent 50%),
                              radial-gradient(circle at 80% 50%, rgba(16, 185, 129, 0.1) 0%, transparent 50%),
                              radial-gradient(circle at 50% 100%, rgba(99, 102, 241, 0.05) 0%, transparent 50%);
        }
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
        .float-animation-delay {
            animation: float 6s ease-in-out 2s infinite;
        }
        .float-animation-delay-2 {
            animation: float 6s ease-in-out 4s infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .gradient-text {
            background: linear-gradient(135deg, #3B82F6, #10B981);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        .stat-counter {
            animation: countUp 1s ease-out forwards;
        }
    </style>
</head>
<body class="bg-white min-h-screen">

    {{-- Navbar --}}
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-lg border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="flex items-center space-x-2">
                <span class="text-2xl">🎓</span>
                <span class="text-xl font-bold text-gray-800">Mini <span class="gradient-text">LMS</span></span>
            </a>

            <div class="hidden md:flex items-center space-x-8">
                <a href="#fonctionnalites" class="text-gray-600 hover:text-blue-600 transition text-sm font-medium">Fonctionnalités</a>
                <a href="#comment" class="text-gray-600 hover:text-blue-600 transition text-sm font-medium">Comment ça marche</a>
                <a href="#stats" class="text-gray-600 hover:text-blue-600 transition text-sm font-medium">Chiffres</a>
            </div>

            <div class="flex items-center space-x-3">
                @auth
                    <a href="{{ route('dashboard') }}"
                       class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-6 py-2.5 rounded-xl font-medium transition shadow-lg shadow-blue-500/20">
                        Mon espace →
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="text-gray-600 hover:text-blue-600 px-4 py-2.5 font-medium transition">
                        Se connecter
                    </a>
                    <a href="{{ route('register') }}"
                       class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-6 py-2.5 rounded-xl font-medium transition shadow-lg shadow-blue-500/20">
                        S'inscrire gratuitement
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <section class="hero-pattern pt-32 pb-20 relative overflow-hidden">
        {{-- Éléments décoratifs flottants --}}
        <div class="absolute top-20 left-10 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 float-animation"></div>
        <div class="absolute top-40 right-10 w-72 h-72 bg-emerald-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 float-animation-delay"></div>
        <div class="absolute bottom-0 left-1/2 w-72 h-72 bg-indigo-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 float-animation-delay-2"></div>

        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                {{-- Texte --}}
                <div>
                    <div class="inline-flex items-center bg-blue-50 text-blue-700 px-4 py-2 rounded-full text-sm font-medium mb-6 border border-blue-100">
                        <span class="mr-2">🚀</span> Plateforme pédagogique nouvelle génération
                    </div>

                    <h1 class="text-5xl md:text-6xl font-bold text-gray-900 leading-tight mb-6">
                        Apprenez.
                        <br>
                        <span class="gradient-text">Progressez.</span>
                        <br>
                        Réussissez.
                    </h1>

                    <p class="text-xl text-gray-600 leading-relaxed mb-8 max-w-lg">
                        Mini LMS est une plateforme qui vous permet d'accéder à des formations structurées,
                        des quiz interactifs et un suivi personnalisé de votre progression.
                    </p>

                    @guest
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="{{ route('register') }}"
                               class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-8 py-4 rounded-xl text-lg font-semibold transition shadow-lg shadow-blue-500/30 text-center">
                                Commencer gratuitement →
                            </a>
                            <a href="{{ route('login') }}"
                               class="bg-white hover:bg-gray-50 text-gray-700 px-8 py-4 rounded-xl text-lg font-semibold transition border border-gray-200 text-center">
                                J'ai déjà un compte
                            </a>
                        </div>

                        <div class="mt-6 flex items-center space-x-4 text-sm text-gray-500">
                            <span class="flex items-center"><span class="text-green-500 mr-1">✓</span> Gratuit</span>
                            <span class="flex items-center"><span class="text-green-500 mr-1">✓</span> Sans carte bancaire</span>
                            <span class="flex items-center"><span class="text-green-500 mr-1">✓</span> Accès immédiat</span>
                        </div>
                    @endguest
                </div>

                {{-- Illustration (cards flottantes) --}}
                <div class="hidden lg:block relative">
                    <div class="relative w-full h-96">
                        {{-- Card Formation --}}
                        <div class="absolute top-0 right-0 w-72 bg-white rounded-2xl shadow-xl p-6 border border-gray-100 float-animation">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mr-3">
                                    <span class="text-2xl">📚</span>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">Anglais B1</p>
                                    <p class="text-xs text-gray-400">3 chapitres • 12 leçons</p>
                                </div>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2">
                                <div class="bg-blue-500 h-2 rounded-full" style="width: 65%"></div>
                            </div>
                            <p class="text-xs text-gray-400 mt-2">65% complété</p>
                        </div>

                        {{-- Card Quiz --}}
                        <div class="absolute top-32 left-0 w-64 bg-white rounded-2xl shadow-xl p-5 border border-gray-100 float-animation-delay">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-sm font-semibold text-gray-800">Quiz terminé !</span>
                                <span class="text-2xl">🎯</span>
                            </div>
                            <div class="text-center">
                                <p class="text-4xl font-bold text-emerald-500">8/10</p>
                                <p class="text-sm text-gray-400 mt-1">80% de réussite</p>
                            </div>
                            <div class="mt-3 flex justify-center">
                                <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-medium">Bravo ! 🎉</span>
                            </div>
                        </div>

                        {{-- Card Note --}}
                        <div class="absolute bottom-0 right-12 w-56 bg-white rounded-2xl shadow-xl p-5 border border-gray-100 float-animation-delay-2">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-semibold text-gray-800">Moyenne</span>
                                <span class="text-2xl">📝</span>
                            </div>
                            <p class="text-3xl font-bold text-blue-600">15.5<span class="text-lg text-gray-400">/20</span></p>
                            <div class="mt-2 flex space-x-1">
                                <div class="w-full bg-blue-500 h-1.5 rounded-full"></div>
                                <div class="w-full bg-blue-500 h-1.5 rounded-full"></div>
                                <div class="w-full bg-blue-500 h-1.5 rounded-full"></div>
                                <div class="w-full bg-gray-200 h-1.5 rounded-full"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Logos / Confiance --}}
    <section class="py-12 bg-gray-50 border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-sm text-gray-400 font-medium mb-6 uppercase tracking-wider">Technologies utilisées</p>
            <div class="flex flex-wrap justify-center items-center gap-8 md:gap-16">
                <span class="text-gray-400 font-semibold text-lg">Laravel</span>
                <span class="text-gray-400 font-semibold text-lg">Tailwind CSS</span>
                <span class="text-gray-400 font-semibold text-lg">SQLite</span>
                <span class="text-gray-400 font-semibold text-lg">Blade</span>
                <span class="text-gray-400 font-semibold text-lg">PHPUnit</span>
            </div>
        </div>
    </section>

    {{-- Fonctionnalités --}}
    <section id="fonctionnalites" class="py-20">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <span class="inline-block bg-blue-50 text-blue-700 px-4 py-2 rounded-full text-sm font-medium mb-4 border border-blue-100">
                    Fonctionnalités
                </span>
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Tout ce dont vous avez besoin</h2>
                <p class="text-lg text-gray-500 max-w-2xl mx-auto">
                    Une plateforme complète pour gérer et suivre des formations en ligne.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Card 1 --}}
                <div class="card-hover bg-white rounded-2xl p-8 border border-gray-100 shadow-sm">
                    <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center mb-6">
                        <span class="text-3xl">📚</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Formations structurées</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Des cours organisés en chapitres et sous-chapitres pour un apprentissage progressif et méthodique.
                    </p>
                    <div class="mt-6 flex flex-wrap gap-2">
                        <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-lg text-xs font-medium">Chapitres</span>
                        <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-lg text-xs font-medium">Sous-chapitres</span>
                        <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-lg text-xs font-medium">Contenu HTML</span>
                    </div>
                </div>

                {{-- Card 2 --}}
                <div class="card-hover bg-white rounded-2xl p-8 border border-gray-100 shadow-sm">
                    <div class="w-14 h-14 bg-emerald-100 rounded-2xl flex items-center justify-center mb-6">
                        <span class="text-3xl">🎯</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Quiz interactifs</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Testez vos connaissances avec des QCM à choix multiples. Score calculé automatiquement avec corrections détaillées.
                    </p>
                    <div class="mt-6 flex flex-wrap gap-2">
                        <span class="bg-emerald-50 text-emerald-700 px-3 py-1 rounded-lg text-xs font-medium">QCM</span>
                        <span class="bg-emerald-50 text-emerald-700 px-3 py-1 rounded-lg text-xs font-medium">Score auto</span>
                        <span class="bg-emerald-50 text-emerald-700 px-3 py-1 rounded-lg text-xs font-medium">Corrections</span>
                    </div>
                </div>

                {{-- Card 3 --}}
                <div class="card-hover bg-white rounded-2xl p-8 border border-gray-100 shadow-sm">
                    <div class="w-14 h-14 bg-purple-100 rounded-2xl flex items-center justify-center mb-6">
                        <span class="text-3xl">📝</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Suivi des résultats</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Consultez vos notes, votre moyenne et l'historique de vos quiz pour suivre votre évolution.
                    </p>
                    <div class="mt-6 flex flex-wrap gap-2">
                        <span class="bg-purple-50 text-purple-700 px-3 py-1 rounded-lg text-xs font-medium">Notes /20</span>
                        <span class="bg-purple-50 text-purple-700 px-3 py-1 rounded-lg text-xs font-medium">Moyenne</span>
                        <span class="bg-purple-50 text-purple-700 px-3 py-1 rounded-lg text-xs font-medium">Historique</span>
                    </div>
                </div>

                {{-- Card 4 --}}
                <div class="card-hover bg-white rounded-2xl p-8 border border-gray-100 shadow-sm">
                    <div class="w-14 h-14 bg-orange-100 rounded-2xl flex items-center justify-center mb-6">
                        <span class="text-3xl">🤖</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Contenu assisté par IA</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Importez ou générez du contenu pédagogique et des quiz grâce à l'intelligence artificielle.
                    </p>
                    <div class="mt-6 flex flex-wrap gap-2">
                        <span class="bg-orange-50 text-orange-700 px-3 py-1 rounded-lg text-xs font-medium">Import IA</span>
                        <span class="bg-orange-50 text-orange-700 px-3 py-1 rounded-lg text-xs font-medium">ChatGPT</span>
                        <span class="bg-orange-50 text-orange-700 px-3 py-1 rounded-lg text-xs font-medium">API OpenAI</span>
                    </div>
                </div>

                {{-- Card 5 --}}
                <div class="card-hover bg-white rounded-2xl p-8 border border-gray-100 shadow-sm">
                    <div class="w-14 h-14 bg-red-100 rounded-2xl flex items-center justify-center mb-6">
                        <span class="text-3xl">👥</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Gestion des apprenants</h3>
                    <p class="text-gray-500 leading-relaxed">
                        L'administrateur gère les comptes, les inscriptions aux formations et les notes de chaque apprenant.
                    </p>
                    <div class="mt-6 flex flex-wrap gap-2">
                        <span class="bg-red-50 text-red-700 px-3 py-1 rounded-lg text-xs font-medium">Inscriptions</span>
                        <span class="bg-red-50 text-red-700 px-3 py-1 rounded-lg text-xs font-medium">Rôles</span>
                        <span class="bg-red-50 text-red-700 px-3 py-1 rounded-lg text-xs font-medium">Profils</span>
                    </div>
                </div>

                {{-- Card 6 --}}
                <div class="card-hover bg-white rounded-2xl p-8 border border-gray-100 shadow-sm">
                    <div class="w-14 h-14 bg-teal-100 rounded-2xl flex items-center justify-center mb-6">
                        <span class="text-3xl">🔒</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Sécurisé et fiable</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Authentification sécurisée, validation des données, protection CSRF et middleware de rôles.
                    </p>
                    <div class="mt-6 flex flex-wrap gap-2">
                        <span class="bg-teal-50 text-teal-700 px-3 py-1 rounded-lg text-xs font-medium">Auth Breeze</span>
                        <span class="bg-teal-50 text-teal-700 px-3 py-1 rounded-lg text-xs font-medium">CSRF</span>
                        <span class="bg-teal-50 text-teal-700 px-3 py-1 rounded-lg text-xs font-medium">Middleware</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Comment ça marche --}}
    <section id="comment" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <span class="inline-block bg-emerald-50 text-emerald-700 px-4 py-2 rounded-full text-sm font-medium mb-4 border border-emerald-100">
                    Comment ça marche
                </span>
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Simple comme 1, 2, 3</h2>
                <p class="text-lg text-gray-500">Commencez à apprendre en quelques minutes.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-blue-500/30">
                        <span class="text-3xl text-white font-bold">1</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Créez votre compte</h3>
                    <p class="text-gray-500">Inscription gratuite en 30 secondes. Aucune carte bancaire requise.</p>
                </div>

                <div class="text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-emerald-500/30">
                        <span class="text-3xl text-white font-bold">2</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Suivez vos formations</h3>
                    <p class="text-gray-500">Naviguez dans les chapitres et sous-chapitres à votre rythme.</p>
                </div>

                <div class="text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-purple-500/30">
                        <span class="text-3xl text-white font-bold">3</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Testez et progressez</h3>
                    <p class="text-gray-500">Passez les quiz, consultez vos scores et améliorez-vous.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats --}}
    <section id="stats" class="py-20">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl p-12 md:p-16">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">La plateforme en chiffres</h2>
                    <p class="text-blue-200">Un projet complet et fonctionnel.</p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div class="text-center">
                        <p class="text-4xl md:text-5xl font-bold text-white mb-2">13</p>
                        <p class="text-blue-200 text-sm">Migrations</p>
                    </div>
                    <div class="text-center">
                        <p class="text-4xl md:text-5xl font-bold text-white mb-2">9</p>
                        <p class="text-blue-200 text-sm">Modèles Eloquent</p>
                    </div>
                    <div class="text-center">
                        <p class="text-4xl md:text-5xl font-bold text-white mb-2">70+</p>
                        <p class="text-blue-200 text-sm">Tests automatisés</p>
                    </div>
                    <div class="text-center">
                        <p class="text-4xl md:text-5xl font-bold text-white mb-2">10</p>
                        <p class="text-blue-200 text-sm">Contrôleurs</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Deux profils --}}
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <span class="inline-block bg-purple-50 text-purple-700 px-4 py-2 rounded-full text-sm font-medium mb-4 border border-purple-100">
                    Deux espaces
                </span>
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Un espace pour chaque rôle</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Admin --}}
                <div class="card-hover bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm">
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-6">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <span class="text-2xl">👨‍💼</span>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-white">Administrateur</h3>
                                <p class="text-blue-200 text-sm">Gestion complète</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3">
                            <li class="flex items-center text-gray-600">
                                <span class="text-blue-500 mr-3">✓</span> Créer et gérer les formations
                            </li>
                            <li class="flex items-center text-gray-600">
                                <span class="text-blue-500 mr-3">✓</span> Organiser chapitres et contenus
                            </li>
                            <li class="flex items-center text-gray-600">
                                <span class="text-blue-500 mr-3">✓</span> Créer des quiz avec QCM
                            </li>
                            <li class="flex items-center text-gray-600">
                                <span class="text-blue-500 mr-3">✓</span> Gérer les apprenants et inscriptions
                            </li>
                            <li class="flex items-center text-gray-600">
                                <span class="text-blue-500 mr-3">✓</span> Attribuer et modifier les notes
                            </li>
                            <li class="flex items-center text-gray-600">
                                <span class="text-blue-500 mr-3">✓</span> Importer du contenu via IA
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Apprenant --}}
                <div class="card-hover bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm">
                    <div class="bg-gradient-to-r from-emerald-600 to-teal-700 p-6">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <span class="text-2xl">👨‍🎓</span>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-white">Apprenant</h3>
                                <p class="text-emerald-200 text-sm">Espace d'apprentissage</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3">
                            <li class="flex items-center text-gray-600">
                                <span class="text-emerald-500 mr-3">✓</span> Consulter ses formations
                            </li>
                            <li class="flex items-center text-gray-600">
                                <span class="text-emerald-500 mr-3">✓</span> Naviguer dans les cours
                            </li>
                            <li class="flex items-center text-gray-600">
                                <span class="text-emerald-500 mr-3">✓</span> Passer des quiz interactifs
                            </li>
                            <li class="flex items-center text-gray-600">
                                <span class="text-emerald-500 mr-3">✓</span> Voir son score et corrections
                            </li>
                            <li class="flex items-center text-gray-600">
                                <span class="text-emerald-500 mr-3">✓</span> Consulter ses notes et moyenne
                            </li>
                            <li class="flex items-center text-gray-600">
                                <span class="text-emerald-500 mr-3">✓</span> Gérer son profil
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Final --}}
    @guest
        <section class="py-20">
            <div class="max-w-4xl mx-auto px-4 text-center">
                <h2 class="text-4xl font-bold text-gray-900 mb-6">Prêt à commencer ?</h2>
                <p class="text-xl text-gray-500 mb-8 max-w-2xl mx-auto">
                    Rejoignez Mini LMS et accédez immédiatement à vos formations.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}"
                       class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-8 py-4 rounded-xl text-lg font-semibold transition shadow-lg shadow-blue-500/30">
                        Créer mon compte gratuitement →
                    </a>
                    <a href="{{ route('login') }}"
                       class="bg-white hover:bg-gray-50 text-gray-700 px-8 py-4 rounded-xl text-lg font-semibold transition border border-gray-200">
                        Se connecter
                    </a>
                </div>
            </div>
        </section>
    @endguest

    {{-- Footer --}}
    <footer class="bg-gray-900 text-gray-400 py-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <span class="text-2xl">🎓</span>
                        <span class="text-xl font-bold text-white">Mini LMS</span>
                    </div>
                    <p class="text-sm leading-relaxed">
                        Plateforme pédagogique développée en Laravel. Projet de stage réalisé avec les bonnes pratiques du développement web.
                    </p>
                </div>

                <div>
                    <h4 class="text-white font-semibold mb-4">Stack technique</h4>
                    <ul class="space-y-2 text-sm">
                        <li>Laravel 11 / PHP 8.3</li>
                        <li>Tailwind CSS</li>
                        <li>SQLite</li>
                        <li>Laravel Breeze</li>
                        <li>PHPUnit</li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-semibold mb-4">Bonnes pratiques</h4>
                    <ul class="space-y-2 text-sm">
                        <li>Migrations & Seeders</li>
                        <li>Form Requests</li>
                        <li>Middleware & Policies</li>
                        <li>Tests unitaires & feature</li>
                        <li>Git & Pull Requests</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm">© {{ date('Y') }} Mini LMS — Salah-Eddine Boudi</p>
                <p class="text-sm mt-2 md:mt-0">Développé avec ❤️ en Laravel</p>
            </div>
        </div>
    </footer>

</body>
</html>