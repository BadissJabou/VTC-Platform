<?php

namespace Tests\Unit;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_booking()
    {
        // Create a service first
        $service = Service::create([
            'name' => 'Test Service',
            'description' => 'Test description',
            'type' => 'airport',
            'base_price' => 50.00,
            'price_unit' => 'fixed',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $booking = Booking::create([
            'reference' => Booking::generateReference(),
            'service_id' => $service->id,
            'client_name' => 'John Doe',
            'client_email' => 'john@example.com',
            'client_phone' => '+33612345678',
            'pickup_address' => '123 Main St',
            'destination_address' => '456 Destination St',
            'pickup_datetime' => now()->addDays(1),
            'estimated_price' => 50.00,
            'status' => 'pending',
            'payment_status' => 'pending',
        ]);

        $this->assertInstanceOf(Booking::class, $booking);
        $this->assertEquals('John Doe', $booking->client_name);
        $this->assertEquals('pending', $booking->status);
        $this->assertStringStartsWith('VTC-', $booking->reference);
    }

    /** @test */
    public function it_generates_unique_references()
    {
        // Create a booking first to have a reference in database
        $service = Service::create([
            'name' => 'Test Service',
            'description' => 'Test description',
            'type' => 'airport',
            'base_price' => 50.00,
            'price_unit' => 'fixed',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $booking1 = Booking::create([
            'reference' => Booking::generateReference(),
            'service_id' => $service->id,
            'client_name' => 'John Doe',
            'client_email' => 'john@example.com',
            'client_phone' => '+33612345678',
            'pickup_address' => '123 Main St',
            'pickup_datetime' => now()->addDays(1),
            'estimated_price' => 50.00,
            'status' => 'pending',
            'payment_status' => 'pending',
        ]);

        $reference2 = Booking::generateReference();

        $this->assertNotEquals($booking1->reference, $reference2);
        $this->assertStringStartsWith('VTC-', $booking1->reference);
        $this->assertStringStartsWith('VTC-', $reference2);
        $this->assertMatchesRegularExpression('/^VTC-\d{4}-\d{4}$/', $booking1->reference);
        $this->assertMatchesRegularExpression('/^VTC-\d{4}-\d{4}$/', $reference2);
    }

    /** @test */
    public function it_belongs_to_a_service()
    {
        $service = Service::create([
            'name' => 'Test Service',
            'description' => 'Test description',
            'type' => 'airport',
            'base_price' => 50.00,
            'price_unit' => 'fixed',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $booking = Booking::create([
            'reference' => Booking::generateReference(),
            'service_id' => $service->id,
            'client_name' => 'John Doe',
            'client_email' => 'john@example.com',
            'client_phone' => '+33612345678',
            'pickup_address' => '123 Main St',
            'pickup_datetime' => now()->addDays(1),
            'estimated_price' => 50.00,
            'status' => 'pending',
            'payment_status' => 'pending',
        ]);

        $this->assertInstanceOf(Service::class, $booking->service);
        $this->assertEquals('Test Service', $booking->service->name);
    }

    /** @test */
    public function it_can_be_confirmed()
    {
        $service = Service::create([
            'name' => 'Test Service',
            'description' => 'Test description',
            'type' => 'airport',
            'base_price' => 50.00,
            'price_unit' => 'fixed',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $booking = Booking::create([
            'reference' => Booking::generateReference(),
            'service_id' => $service->id,
            'client_name' => 'John Doe',
            'client_email' => 'john@example.com',
            'client_phone' => '+33612345678',
            'pickup_address' => '123 Main St',
            'pickup_datetime' => now()->addDays(1),
            'estimated_price' => 50.00,
            'status' => 'pending',
            'payment_status' => 'pending',
        ]);

        $booking->status = 'confirmed';
        $booking->save();

        $this->assertEquals('confirmed', $booking->fresh()->status);
    }

    /** @test */
    public function it_can_be_completed_with_final_price()
    {
        $service = Service::create([
            'name' => 'Test Service',
            'description' => 'Test description',
            'type' => 'airport',
            'base_price' => 50.00,
            'price_unit' => 'fixed',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $booking = Booking::create([
            'reference' => Booking::generateReference(),
            'service_id' => $service->id,
            'client_name' => 'John Doe',
            'client_email' => 'john@example.com',
            'client_phone' => '+33612345678',
            'pickup_address' => '123 Main St',
            'pickup_datetime' => now()->addDays(1),
            'estimated_price' => 50.00,
            'status' => 'confirmed',
            'payment_status' => 'paid',
        ]);

        $booking->status = 'completed';
        $booking->final_price = 55.00; // Slightly different from estimated
        $booking->save();

        $freshBooking = $booking->fresh();
        $this->assertEquals('completed', $freshBooking->status);
        $this->assertEquals(55.00, $freshBooking->final_price);
    }
}
