@extends('layouts.app')

@section('title', 'Nos Services VTC - VTC Platform')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Nos Services VTC</h1>
            <p class="text-xl text-blue-100">Des solutions adaptées à tous vos besoins de déplacement professionnel</p>
        </div>
    </div>
</section>

<!-- Services Detailed -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @foreach($services as $service)
            <div class="bg-white border border-gray-200 rounded-xl shadow-lg hover:shadow-xl transition">
                <div class="p-8">
                    <div class="text-blue-600 mb-6">
                        @if($service->type == 'airport')
                            <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/>
                            </svg>
                        @elseif($service->type == 'business')
                            <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20 6h-2.18c.11-.31.18-.65.18-1a2.996 2.996 0 0 0-5.5-1.65l-.5.67-.5-.68C10.96 2.54 10.05 2 9 2 7.34 2 6 3.34 6 5c0 .35.07.69.18 1H4c-1.11 0-1.99.89-1.99 2L2 19c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V8c0-1.11-.89-2-2-2zm-5-2c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zM9 4c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1z"/>
                            </svg>
                        @else
                            <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                            </svg>
                        @endif
                    </div>
                    
                    <h3 class="text-2xl font-bold mb-4">{{ $service->name }}</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">{{ $service->description }}</p>
                    
                    <div class="bg-blue-50 rounded-lg p-4 mb-6">
                        <div class="text-3xl font-bold text-blue-600 mb-2">
                            @if($service->price_unit == 'from')
                                À partir de {{ number_format($service->base_price, 2, ',', ' ') }}€
                            @elseif($service->price_unit == 'hourly')
                                {{ number_format($service->base_price, 2, ',', ' ') }}€/heure
                            @else
                                {{ number_format($service->base_price, 2, ',', ' ') }}€
                            @endif
                        </div>
                        <p class="text-sm text-gray-600">
                            @if($service->type == 'airport')
                                Tarif variable selon distance et horaire
                            @elseif($service->type == 'business')
                                Sur devis ou à partir du tarif de base
                            @else
                                Tarif horaire avec minimum 2 heures
                            @endif
                        </p>
                    </div>
                    
                    <div class="space-y-3 mb-6">
                        @if($service->type == 'airport')
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                </svg>
                                Suivi de vol en temps réel
                            </div>
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                </svg>
                                Accueil personnalisé avec pancarte
                            </div>
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                </svg>
                                Aide aux bagages incluse
                            </div>
                        @elseif($service->type == 'business')
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                </svg>
                                Service discret et professionnel
                            </div>
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                </svg>
                                Véhicules confortables et climatisés
                            </div>
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                </svg>
                                Facturation professionnelle
                            </div>
                        @else
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                </svg>
                                Chauffeur dédié à votre disposition
                            </div>
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                </svg>
                                Flexibilité horaire et itinéraire
                            </div>
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                </svg>
                                Idéal pour événements et tourisme
                            </div>
                        @endif
                    </div>
                    
                    <a href="{{ route('booking.create') }}" class="w-full bg-blue-600 text-white text-center py-3 rounded-lg font-semibold hover:bg-blue-700 transition block">
                        Réserver ce service
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">Besoin d'un service sur mesure ?</h2>
        <p class="text-xl text-gray-600 mb-8">Contactez-nous pour un devis personnalisé adapté à vos besoins spécifiques</p>
        <div class="space-x-4">
            <a href="{{ route('booking.create') }}" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                Demander un devis
            </a>
            <a href="{{ route('contact') }}" class="border border-blue-600 text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition">
                Nous contacter
            </a>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Questions Fréquentes</h2>
            <p class="text-xl text-gray-600">Tout ce que vous devez savoir sur nos services VTC</p>
        </div>
        
        <div class="space-y-6">
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-3">Comment réserver un service VTC ?</h3>
                <p class="text-gray-600">Rien de plus simple : remplissez notre formulaire de réservation en ligne ou contactez-nous directement par téléphone. Nous vous confirmerons votre réservation rapidement.</p>
            </div>
            
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-3">Quels sont les moyens de paiement acceptés ?</h3>
                <p class="text-gray-600">Nous acceptons les paiements par carte bancaire, espèces, et virement bancaire. Pour les clients réguliers, nous proposons également des solutions de facturation mensuelle.</p>
            </div>
            
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-3">Puis-je annuler ma réservation ?</h3>
                <p class="text-gray-600">Oui, vous pouvez annuler gratuitement jusqu'à 24h avant votre course. Passé ce délai, des frais d'annulation peuvent s'appliquer selon nos conditions générales.</p>
            </div>
            
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-3">Les prix incluent-ils tout ?</h3>
                <p class="text-gray-600">Nos prix incluent le véhicule, le chauffeur professionnel, l'assurance et les frais de base. Les péages, parking et suppléments nocturnes sont en sus et seront clairement indiqués dans votre devis.</p>
            </div>
        </div>
    </div>
</section>
@endsection
