@extends('layouts.app')

@section('title', 'VTC Platform - Votre Chauffeur Privé Professionnel')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                VTC Platform<br>
                <span class="text-blue-200">Votre Chauffeur Privé Professionnel</span>
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-blue-100">
                Transferts aéroport, trajets professionnels, événements...<br>
                Un service VTC fiable, ponctuel et confortable.
            </p>
            <div class="space-x-4">
                <a href="{{ route('booking.create') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition inline-block">
                    Réserver maintenant
                </a>
                <a href="{{ route('services') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition inline-block">
                    Voir nos services
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Services Preview -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Nos Services VTC</h2>
            <p class="text-xl text-gray-600">Des solutions adaptées à tous vos besoins de déplacement</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($services as $service)
            <div class="bg-gray-50 rounded-lg p-8 hover:shadow-lg transition">
                <div class="text-blue-600 mb-4">
                    @if($service->type == 'airport')
                        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/>
                        </svg>
                    @elseif($service->type == 'business')
                        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    @else
                        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                        </svg>
                    @endif
                </div>
                <h3 class="text-xl font-semibold mb-3">{{ $service->name }}</h3>
                <p class="text-gray-600 mb-4">{{ $service->description }}</p>
                <div class="text-2xl font-bold text-blue-600">
                    @if($service->price_unit == 'from')
                        À partir de {{ number_format($service->base_price, 2, ',', ' ') }}€
                    @elseif($service->price_unit == 'hourly')
                        {{ number_format($service->base_price, 2, ',', ' ') }}€/heure
                    @else
                        {{ number_format($service->base_price, 2, ',', ' ') }}€
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('services') }}" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                Découvrir tous nos services
            </a>
        </div>
    </div>
</section>

<!-- Features -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Pourquoi nous choisir ?</h2>
            <p class="text-xl text-gray-600">Un service premium pour une expérience exceptionnelle</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zm4.2 14.2L11 13V7h1.5v5.2l4.5 2.7-.8 1.3z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Ponctualité garantie</h3>
                <p class="text-gray-600">Nous arrivons toujours à l'heure, tracking en temps réel</p>
            </div>
            <div class="text-center">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Sécurité maximale</h3>
                <p class="text-gray-600">Véhicules assurés, chauffeurs professionnels</p>
            </div>
            <div class="text-center">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Service premium</h3>
                <p class="text-gray-600">Véhicules confortables et service client disponible</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="bg-blue-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Prêt à réserver votre course ?</h2>
        <p class="text-xl mb-8">Contactez-nous dès maintenant pour un devis personnalisé</p>
        <a href="{{ route('booking.create') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition inline-block">
            Réserver ma course
        </a>
    </div>
</section>
@endsection
