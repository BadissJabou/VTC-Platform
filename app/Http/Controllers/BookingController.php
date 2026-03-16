<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Service;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function create()
    {
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        return view('booking.create', compact('services'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_id' => 'required|exists:services,id',
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email|max:255',
            'client_phone' => 'required|string|max:20',
            'pickup_address' => 'required|string|max:500',
            'destination_address' => 'nullable|string|max:500',
            'pickup_date' => 'required|date|after_or_equal:today',
            'pickup_time' => 'required',
            'return_date' => 'nullable|date|after_or_equal:pickup_date',
            'return_time' => 'nullable',
            'notes' => 'nullable|string|max:1000',
            'terms' => 'required'
        ], [
            'service_id.required' => 'Veuillez sélectionner un type de service.',
            'client_name.required' => 'Le nom complet est obligatoire.',
            'client_email.required' => 'L\'email est obligatoire.',
            'client_email.email' => 'Veuillez entrer une adresse email valide.',
            'client_phone.required' => 'Le numéro de téléphone est obligatoire.',
            'pickup_address.required' => 'L\'adresse de départ est obligatoire.',
            'pickup_date.after_or_equal' => 'La date de départ doit être aujourd\'ui ou dans le futur.',
            'terms.required' => 'Vous devez accepter les conditions générales.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Combine date and time for pickup datetime
        $pickupDatetime = $request->pickup_date . ' ' . $request->pickup_time;
        $returnDatetime = null;
        
        if ($request->return_date && $request->return_time) {
            $returnDatetime = $request->return_date . ' ' . $request->return_time;
        }

        // Get service for estimated price
        $service = Service::findOrFail($request->service_id);
        $estimatedPrice = $service->base_price;

        // Create booking
        $booking = Booking::create([
            'reference' => Booking::generateReference(),
            'service_id' => $request->service_id,
            'client_name' => $request->client_name,
            'client_email' => $request->client_email,
            'client_phone' => $request->client_phone,
            'pickup_address' => $request->pickup_address,
            'destination_address' => $request->destination_address,
            'pickup_datetime' => $pickupDatetime,
            'return_datetime' => $returnDatetime,
            'estimated_price' => $estimatedPrice,
            'status' => 'pending',
            'notes' => $request->notes,
            'payment_status' => 'pending'
        ]);

        // TODO: Send confirmation email to client
        // TODO: Send notification to admin

        return redirect()->route('booking.confirmation', $booking->reference)
            ->with('success', 'Votre réservation a été enregistrée avec succès !');
    }

    public function confirmation($reference)
    {
        $booking = Booking::where('reference', $reference)->firstOrFail();
        return view('booking.confirmation', compact('booking'));
    }
}
