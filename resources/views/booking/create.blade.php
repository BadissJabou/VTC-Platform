@extends('layouts.app')

@section('title', 'Réservation VTC - VTC Platform')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Réserver votre course VTC</h1>
            <p class="text-xl text-blue-100">Remplissez ce formulaire pour réserver votre chauffeur privé</p>
        </div>
    </div>
</section>

<!-- Booking Form -->
<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-lg p-8">
            <form action="{{ route('booking.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Service Selection -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Type de service *</label>
                    <select name="service_id" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Sélectionnez un service</option>
                        @foreach($services as $service)
                        <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                            {{ $service->name }} - 
                            @if($service->price_unit == 'from')
                                À partir de {{ number_format($service->base_price, 2, ',', ' ') }}€
                            @elseif($service->price_unit == 'hourly')
                                {{ number_format($service->base_price, 2, ',', ' ') }}€/heure
                            @else
                                {{ number_format($service->base_price, 2, ',', ' ') }}€
                            @endif
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Client Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nom complet *</label>
                        <input type="text" name="client_name" required value="{{ old('client_name') }}" 
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Jean Dupont">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                        <input type="email" name="client_email" required value="{{ old('client_email') }}" 
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="jean.dupont@email.com">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Téléphone *</label>
                    <input type="tel" name="client_phone" required value="{{ old('client_phone') }}" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="06 12 34 56 78">
                </div>

                <!-- Trip Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Adresse de départ *</label>
                        <input type="text" name="pickup_address" required value="{{ old('pickup_address') }}" 
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="123 Rue de la République, 75001 Paris">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Adresse de destination</label>
                        <input type="text" name="destination_address" value="{{ old('destination_address') }}" 
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Aéroport Charles de Gaulle, Terminal 2">
                    </div>
                </div>

                <!-- Date and Time -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Date de départ *</label>
                        <input type="date" name="pickup_date" required value="{{ old('pickup_date') }}" 
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Heure de départ *</label>
                        <input type="time" name="pickup_time" required value="{{ old('pickup_time') }}" 
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <!-- Return Date (Optional) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Date de retour (optionnel)</label>
                        <input type="date" name="return_date" value="{{ old('return_date') }}" 
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Heure de retour (optionnel)</label>
                        <input type="time" name="return_time" value="{{ old('return_time') }}" 
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <!-- Additional Notes -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Informations complémentaires</label>
                    <textarea name="notes" rows="4" 
                              class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Numéro de vol, bagages spéciaux, demandes particulières...">{{ old('notes') }}</textarea>
                </div>

                <!-- Terms and Conditions -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <label class="flex items-start">
                        <input type="checkbox" name="terms" required class="mt-1 mr-3">
                        <span class="text-sm text-gray-700">
                            J'accepte les <a href="#" class="text-blue-600 hover:underline">conditions générales de service</a> 
                            et confirme avoir lu la <a href="#" class="text-blue-600 hover:underline">politique de confidentialité</a>.
                            Les champs marqués d'un * sont obligatoires.
                        </span>
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center">
                    <button type="submit" 
                            class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                        Confirmer ma réservation
                    </button>
                </div>
            </form>
        </div>

        <!-- Information Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
            <div class="bg-white rounded-lg p-6 text-center">
                <div class="text-blue-600 mb-4">
                    <svg class="w-12 h-12 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                </div>
                <h3 class="font-semibold mb-2">Confirmation rapide</h3>
                <p class="text-sm text-gray-600">Vous recevrez une confirmation par email et SMS sous 2 heures</p>
            </div>
            
            <div class="bg-white rounded-lg p-6 text-center">
                <div class="text-blue-600 mb-4">
                    <svg class="w-12 h-12 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/>
                    </svg>
                </div>
                <h3 class="font-semibold mb-2">Paiement sécurisé</h3>
                <p class="text-sm text-gray-600">Plusieurs options de paiement disponibles</p>
            </div>
            
            <div class="bg-white rounded-lg p-6 text-center">
                <div class="text-blue-600 mb-4">
                    <svg class="w-12 h-12 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                    </svg>
                </div>
                <h3 class="font-semibold mb-2">Annulation flexible</h3>
                <p class="text-sm text-gray-600">Annulation gratuite jusqu'à 24h avant</p>
            </div>
        </div>
    </div>
</section>
@endsection
