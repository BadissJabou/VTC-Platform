<?php

namespace Tests\Feature;

use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingFlowTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_booking_form()
    {
        // Create a service for testing
        $service = Service::create([
            'name' => 'Aéroport Transfer',
            'description' => 'Transfer vers aéroport',
            'type' => 'airport',
            'base_price' => 50.00,
            'price_unit' => 'fixed',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $response = $this->get('/booking');

        $response->assertStatus(200);
        $response->assertSee('Aéroport Transfer');
        $response->assertSee('Réservation');
    }

    /** @test */
    public function it_can_submit_booking_form()
    {
        // Create a service for testing
        $service = Service::create([
            'name' => 'Aéroport Transfer',
            'description' => 'Transfer vers aéroport',
            'type' => 'airport',
            'base_price' => 50.00,
            'price_unit' => 'fixed',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $bookingData = [
            'service_id' => $service->id,
            'client_name' => 'John Doe',
            'client_email' => 'john@example.com',
            'client_phone' => '+33612345678',
            'pickup_address' => '123 Main St',
            'destination_address' => '456 Destination St',
            'pickup_date' => now()->addDays(1)->format('Y-m-d'),
            'pickup_time' => '10:00',
            'notes' => 'Test booking',
            'terms' => 'on',
        ];

        $response = $this->post('/booking', $bookingData);

        $response->assertRedirect();
        $this->assertDatabaseHas('bookings', [
            'client_name' => 'John Doe',
            'client_email' => 'john@example.com',
            'pickup_address' => '123 Main St',
            'status' => 'pending',
        ]);
    }

    /** @test */
    public function it_validates_required_booking_fields()
    {
        $response = $this->post('/booking', [
            'client_name' => '',
            'client_email' => '',
            'client_phone' => '',
            'pickup_address' => '',
        ]);

        $response->assertSessionHasErrors([
            'service_id',
            'client_name',
            'client_email',
            'client_phone',
            'pickup_address',
            'pickup_date',
            'pickup_time',
            'terms',
        ]);
    }

    /** @test */
    public function it_validates_email_format()
    {
        $response = $this->post('/booking', [
            'service_id' => 1,
            'client_name' => 'John Doe',
            'client_email' => 'invalid-email',
            'client_phone' => '+33612345678',
            'pickup_address' => '123 Main St',
            'pickup_date' => now()->addDays(1)->format('Y-m-d'),
            'pickup_time' => '10:00',
            'terms' => 'on',
        ]);

        $response->assertSessionHasErrors(['client_email']);
    }

    /** @test */
    public function it_validates_pickup_date_is_not_past()
    {
        $response = $this->post('/booking', [
            'service_id' => 1,
            'client_name' => 'John Doe',
            'client_email' => 'john@example.com',
            'client_phone' => '+33612345678',
            'pickup_address' => '123 Main St',
            'pickup_date' => now()->subDays(1)->format('Y-m-d'), // Yesterday
            'pickup_time' => '10:00',
            'terms' => 'on',
        ]);

        $response->assertSessionHasErrors(['pickup_date']);
    }

    /** @test */
    public function it_shows_confirmation_page_after_booking()
    {
        // Create a service for testing
        $service = Service::create([
            'name' => 'Aéroport Transfer',
            'description' => 'Transfer vers aéroport',
            'type' => 'airport',
            'base_price' => 50.00,
            'price_unit' => 'fixed',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $bookingData = [
            'service_id' => $service->id,
            'client_name' => 'John Doe',
            'client_email' => 'john@example.com',
            'client_phone' => '+33612345678',
            'pickup_address' => '123 Main St',
            'pickup_date' => now()->addDays(1)->format('Y-m-d'),
            'pickup_time' => '10:00',
            'terms' => 'on',
        ];

        $response = $this->post('/booking', $bookingData);

        // Get the booking reference from the redirect
        $booking = \App\Models\Booking::where('client_email', 'john@example.com')->first();
        
        $response = $this->get("/booking/confirmation/{$booking->reference}");
        
        $response->assertStatus(200);
        $response->assertSee('Réservation Confirmée !');
        $response->assertSee('John Doe');
        $response->assertSee($booking->reference);
    }
}
