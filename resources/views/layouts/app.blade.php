<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'VTC Platform - Chauffeur Privé Professionnel')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600">
                        VTC Platform
                    </a>
                </div>
                <div class="flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 transition">Accueil</a>
                    <a href="{{ route('services') }}" class="text-gray-700 hover:text-blue-600 transition">Services</a>
                    <a href="{{ route('booking.create') }}" class="text-gray-700 hover:text-blue-600 transition">Réservation</a>
                    <a href="{{ route('contact') }}" class="text-gray-700 hover:text-blue-600 transition">Contact</a>
                    <a href="{{ route('booking.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                        Réserver maintenant
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">VTC Platform</h3>
                    <p class="text-gray-300">Service de chauffeur VTC professionnel, fiable et disponible pour tous vos déplacements.</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Services</h3>
                    <ul class="space-y-2 text-gray-300">
                        <li>Transferts aéroport/gare</li>
                        <li>Trajets professionnels</li>
                        <li>Mise à disposition</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Contact</h3>
                    <p class="text-gray-300">Téléphone: 06 XX XX XX XX</p>
                    <p class="text-gray-300">Email: contact@vtcplatform.fr</p>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} VTC Platform - Tous droits réservés</p>
            </div>
        </div>
    </footer>
</body>
</html>
