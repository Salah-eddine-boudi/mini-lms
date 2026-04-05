<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 — Page introuvable</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="text-center">
        <h1 class="text-8xl font-bold text-blue-500 mb-4">404</h1>
        <h2 class="text-2xl font-semibold text-gray-800 mb-2">Page introuvable</h2>
        <p class="text-gray-500 mb-8">La page que vous cherchez n'existe pas ou a été déplacée.</p>
        <a href="{{ url('/') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition">
            ← Retour à l'accueil
        </a>
    </div>
</body>
</html>