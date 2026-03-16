@extends('layouts.app')

@section('title', 'Confirmation Réservation - VTC Platform')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-green-600 to-green-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <div class="mb-6">
                <svg class="w-20 h-20 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Réservation Confirmée !</h1>
            <p class="text-xl text-green-100">Votre course VTC a été enregistrée avec succès</p>
        </div>
    </div>
</section>

<!-- Booking Details -->
<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Détails de votre réservation</h2>
                <p class="text-lg text-gray-600">Référence : <span class="font-mono bg-blue-100 px-3 py-1 rounded">{{ $booking->reference }}</span></p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Client Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Informations client</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Nom :</span>
                            <span class="font-medium">{{ $booking->client_name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Email :</span>
                            <span class="font-medium">{{ $booking->client_email }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Téléphone :</span>
                            <span class="font-medium">{{ $booking->client_phone }}</span>
                        </div>
                    </div>
                </div>

                <!-- Service Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Service réservé</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Service :</span>
                            <span class="font-medium">{{ $booking->service->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Statut :</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                En attente de confirmation
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Prix estimé :</span>
                            <span class="font-medium text-blue-600">{{ number_format($booking->estimated_price, 2, ',', ' ') }}€</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Trip Details -->
            <div class="mt-8 border-t pt-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Détails du trajet</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <div class="flex items-start space-x-3">
                            <div class="bg-green-100 rounded-full p-2 mt-1">
                                <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="8"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Départ</p>
                                <p class="font-medium">{{ $booking->pickup_address }}</p>
                                <p class="text-sm text-gray-600">{{ $booking->pickup_datetime->format('d/m/Y à H:i') }}</p>
                            </div>
                        </div>
                    </div>
                    
                    @if($booking->destination_address)
                    <div>
                        <div class="flex items-start space-x-3">
                            <div class="bg-red-100 rounded-full p-2 mt-1">
                                <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Destination</p>
                                <p class="font-medium">{{ $booking->destination_address }}</p>
                                @if($booking->return_datetime)
                                <p class="text-sm text-gray-600">Retour : {{ $booking->return_datetime->format('d/m/Y à H:i') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                
                @if($booking->notes)
                <div class="mt-4">
                    <p class="text-sm text-gray-600">Notes :</p>
                    <p class="text-gray-800 bg-gray-50 p-3 rounded">{{ $booking->notes }}</p>
                </div>
                @endif
            </div>

            <!-- Next Steps -->
            <div class="mt-8 bg-blue-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Prochaines étapes</h3>
                <div class="space-y-2">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                        </svg>
                        <span class="text-gray-700">Vous recevrez une confirmation par email sous 2 heures</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                        </svg>
                        <span class="text-gray-700">Notre chauffeur vous contactera 24h avant la course</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                        </svg>
                        <span class="text-gray-700">Paiement possible par carte, espèces ou virement</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition text-center">
                    Retour à l'accueil
                </a>
                <a href="{{ route('contact') }}" class="border border-blue-600 text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-blue-50 transition text-center">
                    Nous contacter
                </a>
            </div>
        </div>

        <!-- Important Information -->
        <div class="mt-8 bg-yellow-50 border border-yellow-200 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-3">Informations importantes</h3>
            <ul class="space-y-2 text-gray-700">
                <li>• Annulation gratuite jusqu'à 24h avant le départ</li>
                <li>• Présentez-vous 10 minutes avant l'heure prévue</li>
                <li>• Pour les transferts aéroport : indiquez votre numéro de vol dans les notes</li>
                <li>• Conservez cette référence pour toute communication future</li>
            </ul>
        </div>
    </div>
</section>
@endsection
