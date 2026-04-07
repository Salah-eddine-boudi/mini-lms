<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription — Mini LMS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-emerald-900 via-emerald-800 to-teal-900 flex items-center justify-center p-4">

    <div class="w-full max-w-5xl flex rounded-2xl shadow-2xl overflow-hidden bg-white">

        {{-- Partie gauche — Branding --}}
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-emerald-600 to-teal-700 p-12 flex-col justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">🎓 Mini LMS</h1>
                <p class="text-emerald-200">Plateforme pédagogique</p>
            </div>

            <div>
                <h2 class="text-2xl font-bold text-white mb-4">Rejoignez-nous !</h2>
                <p class="text-emerald-100 leading-relaxed">
                    Créez votre compte et commencez à apprendre dès maintenant.
                </p>

                <div class="mt-8 space-y-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-emerald-500 bg-opacity-30 rounded-lg flex items-center justify-center mr-4">
                            <span class="text-xl">✨</span>
                        </div>
                        <p class="text-emerald-100 text-sm">Inscription gratuite et rapide</p>
                    </div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-emerald-500 bg-opacity-30 rounded-lg flex items-center justify-center mr-4">
                            <span class="text-xl">📚</span>
                        </div>
                        <p class="text-emerald-100 text-sm">Accès immédiat aux formations</p>
                    </div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-emerald-500 bg-opacity-30 rounded-lg flex items-center justify-center mr-4">
                            <span class="text-xl">🎯</span>
                        </div>
                        <p class="text-emerald-100 text-sm">Progressez à votre rythme</p>
                    </div>
                </div>
            </div>

            <p class="text-emerald-300 text-xs">© {{ date('Y') }} Mini LMS — Tous droits réservés</p>
        </div>

        {{-- Partie droite — Formulaire --}}
        <div class="w-full lg:w-1/2 p-8 md:p-12">
            <div class="mb-8">
                <div class="lg:hidden mb-6">
                    <h1 class="text-2xl font-bold text-emerald-600">🎓 Mini LMS</h1>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Créer un compte</h2>
                <p class="text-gray-500 mt-2">Remplissez le formulaire pour commencer</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Nom et Prénom --}}
                <div class="grid grid-cols-2 gap-4 mb-5">
                    <div>
                        <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                        <input type="text"
                               name="nom"
                               id="nom"
                               value="{{ old('nom') }}"
                               placeholder="Dupont"
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition
                                      @error('nom') border-red-500 @enderror">
                        @error('nom')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="prenom" class="block text-sm font-medium text-gray-700 mb-2">Prénom</label>
                        <input type="text"
                               name="prenom"
                               id="prenom"
                               value="{{ old('prenom') }}"
                               placeholder="Jean"
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition
                                      @error('prenom') border-red-500 @enderror">
                        @error('prenom')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Email --}}
                <div class="mb-5">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Adresse email</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">📧</span>
                        <input type="email"
                               name="email"
                               id="email"
                               value="{{ old('email') }}"
                               placeholder="votre@email.fr"
                               required
                               class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition
                                      @error('email') border-red-500 @enderror">
                    </div>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Mot de passe --}}
                <div class="mb-5">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Mot de passe</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">🔒</span>
                        <input type="password"
                               name="password"
                               id="password"
                               placeholder="Minimum 8 caractères"
                               required
                               class="w-full pl-10 pr-12 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition
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

                    {{-- Indicateur de force --}}
                    <div class="mt-2">
                        <div class="h-1.5 w-full bg-gray-200 rounded-full overflow-hidden">
                            <div id="strengthBar" class="h-full rounded-full transition-all duration-300" style="width: 0%"></div>
                        </div>
                        <p id="strengthText" class="text-xs mt-1 text-gray-400"></p>
                    </div>
                </div>

                {{-- Confirmation mot de passe --}}
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                        Confirmer le mot de passe
                    </label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">🔒</span>
                        <input type="password"
                               name="password_confirmation"
                               id="password_confirmation"
                               placeholder="Retapez le mot de passe"
                               required
                               class="w-full pl-10 pr-12 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
                        <button type="button"
                                onclick="togglePassword('password_confirmation', 'eyeIcon2')"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition">
                            <span id="eyeIcon2">👁️</span>
                        </button>
                    </div>
                    <p id="matchText" class="text-xs mt-1"></p>
                </div>

                <input type="hidden" name="name" id="name" value="">

                {{-- Bouton inscription --}}
                <button type="submit"
                        class="w-full bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white py-3 rounded-xl font-semibold text-lg transition shadow-lg shadow-emerald-500/30">
                    Créer mon compte
                </button>
            </form>

            {{-- Lien connexion --}}
            <div class="mt-8 text-center">
                <p class="text-gray-500 text-sm">
                    Vous avez déjà un compte ?
                    <a href="{{ route('login') }}" class="text-emerald-600 hover:text-emerald-800 font-semibold transition">
                        Se connecter
                    </a>
                </p>
            </div>
        </div>
    </div>

    <script>
        // Afficher/masquer mot de passe
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

        // Remplir le champ name
        const nom = document.getElementById('nom');
        const prenom = document.getElementById('prenom');
        const nameField = document.getElementById('name');

        function updateName() {
            nameField.value = (prenom.value + ' ' + nom.value).trim();
        }
        nom.addEventListener('input', updateName);
        prenom.addEventListener('input', updateName);

        // Indicateur de force du mot de passe
        const passwordInput = document.getElementById('password');
        const strengthBar = document.getElementById('strengthBar');
        const strengthText = document.getElementById('strengthText');

        passwordInput.addEventListener('input', function() {
            const val = this.value;
            let score = 0;
            let label = '';

            if (val.length >= 8) score++;
            if (val.length >= 12) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;

            if (val.length === 0) {
                strengthBar.style.width = '0%';
                strengthBar.className = 'h-full rounded-full transition-all duration-300';
                strengthText.textContent = '';
            } else if (score <= 1) {
                strengthBar.style.width = '20%';
                strengthBar.className = 'h-full rounded-full transition-all duration-300 bg-red-500';
                strengthText.textContent = '🔴 Très faible';
                strengthText.className = 'text-xs mt-1 text-red-500';
            } else if (score === 2) {
                strengthBar.style.width = '40%';
                strengthBar.className = 'h-full rounded-full transition-all duration-300 bg-orange-500';
                strengthText.textContent = '🟠 Faible';
                strengthText.className = 'text-xs mt-1 text-orange-500';
            } else if (score === 3) {
                strengthBar.style.width = '60%';
                strengthBar.className = 'h-full rounded-full transition-all duration-300 bg-yellow-500';
                strengthText.textContent = '🟡 Moyen';
                strengthText.className = 'text-xs mt-1 text-yellow-500';
            } else if (score === 4) {
                strengthBar.style.width = '80%';
                strengthBar.className = 'h-full rounded-full transition-all duration-300 bg-green-500';
                strengthText.textContent = '🟢 Fort';
                strengthText.className = 'text-xs mt-1 text-green-500';
            } else {
                strengthBar.style.width = '100%';
                strengthBar.className = 'h-full rounded-full transition-all duration-300 bg-emerald-500';
                strengthText.textContent = '✅ Très fort';
                strengthText.className = 'text-xs mt-1 text-emerald-500';
            }
        });

        // Vérification correspondance mot de passe
        const confirmInput = document.getElementById('password_confirmation');
        const matchText = document.getElementById('matchText');

        confirmInput.addEventListener('input', function() {
            if (this.value.length === 0) {
                matchText.textContent = '';
            } else if (this.value === passwordInput.value) {
                matchText.textContent = '✅ Les mots de passe correspondent';
                matchText.className = 'text-xs mt-1 text-green-500';
            } else {
                matchText.textContent = '❌ Les mots de passe ne correspondent pas';
                matchText.className = 'text-xs mt-1 text-red-500';
            }
        });
    </script>

</body>
</html>