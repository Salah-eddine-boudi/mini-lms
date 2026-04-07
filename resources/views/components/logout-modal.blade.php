{{-- Modal de déconnexion --}}
<div id="logoutModal"
     class="fixed inset-0 z-50 hidden items-center justify-center"
     style="background-color: rgba(0,0,0,0.5); backdrop-filter: blur(4px);">

    <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-sm w-full mx-4 transform transition-all"
         id="logoutModalContent">

        {{-- Icône --}}
        <div class="text-center mb-6">
            <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="text-4xl">👋</span>
            </div>
            <h3 class="text-xl font-bold text-gray-800">Vous partez déjà ?</h3>
            <p class="text-gray-500 mt-2 text-sm">
                Êtes-vous sûr de vouloir vous déconnecter ?
            </p>
        </div>

        {{-- Boutons --}}
        <div class="flex gap-3">
            <button onclick="closeLogoutModal()"
                    class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 rounded-xl font-semibold transition">
                Annuler
            </button>
            <form method="POST" action="{{ route('logout') }}" class="flex-1">
                @csrf
                <button type="submit"
                        class="w-full bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white py-3 rounded-xl font-semibold transition shadow-lg shadow-red-500/30">
                    Déconnexion
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function openLogoutModal() {
        const modal = document.getElementById('logoutModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        // Animation d'entrée
        const content = document.getElementById('logoutModalContent');
        content.style.transform = 'scale(0.95)';
        content.style.opacity = '0';
        setTimeout(() => {
            content.style.transform = 'scale(1)';
            content.style.opacity = '1';
        }, 10);
    }

    function closeLogoutModal() {
        const modal = document.getElementById('logoutModal');
        const content = document.getElementById('logoutModalContent');
        content.style.transform = 'scale(0.95)';
        content.style.opacity = '0';
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 200);
    }

    // Fermer en cliquant en dehors
    document.getElementById('logoutModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeLogoutModal();
        }
    });

    // Fermer avec Échap
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeLogoutModal();
        }
    });
</script>