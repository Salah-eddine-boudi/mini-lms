<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — Mini LMS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-900 via-blue-800 to-indigo-900 flex items-center justify-center p-4">

    <div class="w-full max-w-5xl flex rounded-2xl shadow-2xl overflow-hidden bg-white">

        {{-- Partie gauche — Branding --}}
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-blue-600 to-indigo-700 p-12 flex-col justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">🎓 Mini LMS</h1>
                <p class="text-blue-200">Plateforme pédagogique</p>
            </div>

            <div>
                <h2 class="text-2xl font-bold text-white mb-4">Bienvenue !</h2>
                <p class="text-blue-100 leading-relaxed">
                    Accédez à vos formations, passez des quiz interactifs et suivez votre progression.
                </p>

                <div class="mt-8 space-y-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-blue-500 bg-opacity-30 rounded-lg flex items-center justify-center mr-4">
                            <span class="text-xl">📚</span>
                        </div>
                        <p class="text-blue-100 text-sm">Formations structurées en chapitres</p>
                    </div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-blue-500 bg-opacity-30 rounded-lg flex items-center justify-center mr-4">
                            <span class="text-xl">🎯</span>
                        </div>
                        <p class="text-blue-100 text-sm">Quiz interactifs avec score instantané</p>
                    </div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-blue-500 bg-opacity-30 rounded-lg flex items-center justify-center mr-4">
                            <span class="text-xl">📝</span>
                        </div>
                        <p class="text-blue-100 text-sm">Suivi des notes et résultats</p>
                    </div>
                </div>
            </div>

            <p class="text-blue-300 text-xs">© {{ date('Y') }} Mini LMS — Tous droits réservés</p>
        </div>

        {{-- Partie droite — Formulaire --}}
        <div class="w-full lg:w-1/2 p-8 md:p-12">
            <div class="mb-8">
                <div class="lg:hidden mb-6">
                    <h1 class="text-2xl font-bold text-blue-600">🎓 Mini LMS</h1>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Connexion</h2>
                <p class="text-gray-500 mt-2">Entrez vos identifiants pour accéder à votre espace</p>
            </div>

            @if(session('status'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="mb-5">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Adresse email
                    </label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">📧</span>
                        <input type="email"
                               name="email"
                               id="email"
                               value="{{ old('email') }}"
                               placeholder="votre@email.fr"
                               required
                               autofocus
                               class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition
                                      @error('email') border-red-500 @enderror">
                    </div>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Mot de passe --}}
                <div class="mb-5">
                    <div class="flex justify-between items-center mb-2">
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Mot de passe
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                               class="text-sm text-blue-600 hover:text-blue-800 transition">
                                Mot de passe oublié ?
                            </a>
                        @endif
                    </div>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">🔒</span>
                        <input type="password"
                               name="password"
                               id="password"
                               placeholder="••••••••"
                               required
                               class="w-full pl-10 pr-12 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition
                                      @error('password') border-red-500 @enderror">
                        <button type="button"
                                onclick="togglePassword('password', 'eyeIcon1')"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition">
                            <span id="eyeIcon1">👁️</span>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Se souvenir de moi --}}
                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox"
                               name="remember"
                               class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500 border-gray-300">
                        <span class="ml-2 text-sm text-gray-600">Se souvenir de moi</span>
                    </label>
                </div>

                {{-- Bouton connexion --}}
                <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white py-3 rounded-xl font-semibold text-lg transition shadow-lg shadow-blue-500/30">
                    Se connecter
                </button>
            </form>

            {{-- Lien inscription --}}
            <div class="mt-8 text-center">
                <p class="text-gray-500 text-sm">
                    Pas encore de compte ?
                    <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-semibold transition">
                        Créer un compte
                    </a>
                </p>
            </div>

            {{-- Identifiants démo --}}
            <div class="mt-6 p-4 bg-gray-50 rounded-xl border border-gray-200">
                <p class="text-xs text-gray-400 mb-2 font-semibold uppercase">Comptes de démonstration</p>
                <div class="grid grid-cols-2 gap-2 text-xs">
                    <div class="bg-white p-2 rounded-lg border border-gray-100 cursor-pointer hover:border-blue-300 transition"
                         onclick="document.getElementById('email').value='admin@lms.fr'; document.getElementById('password').value='password';">
                        <p class="font-semibold text-gray-700">👨‍💼 Admin</p>
                        <p class="text-gray-500">admin@lms.fr</p>
                        <p class="text-gray-400">password</p>
                        <p class="text-blue-500 text-xs mt-1">Cliquer pour remplir</p>
                    </div>
                    <div class="bg-white p-2 rounded-lg border border-gray-100 cursor-pointer hover:border-emerald-300 transition"
                         onclick="document.getElementById('email').value='apprenant1@lms.fr'; document.getElementById('password').value='password';">
                        <p class="font-semibold text-gray-700">👨‍🎓 Apprenant</p>
                        <p class="text-gray-500">apprenant1@lms.fr</p>
                        <p class="text-gray-400">password</p>
                        <p class="text-emerald-500 text-xs mt-1">Cliquer pour remplir</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = '🙈';
            } else {
                input.type = 'password';
                icon.textContent = '👁️';
            }
        }
    </script>

</body>
</html>