<?php

namespace Tests\Unit;

use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_service()
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

        $this->assertInstanceOf(Service::class, $service);
        $this->assertEquals('Test Service', $service->name);
        $this->assertEquals('airport', $service->type);
        $this->assertEquals(50.00, $service->base_price);
        $this->assertTrue($service->is_active);
    }

    /** @test */
    public function it_can_scope_active_services()
    {
        // Create active service
        $activeService = Service::create([
            'name' => 'Active Service',
            'description' => 'Active',
            'type' => 'airport',
            'base_price' => 50.00,
            'price_unit' => 'fixed',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        // Create inactive service
        $inactiveService = Service::create([
            'name' => 'Inactive Service',
            'description' => 'Inactive',
            'type' => 'business',
            'base_price' => 75.00,
            'price_unit' => 'hourly',
            'is_active' => false,
            'sort_order' => 2,
        ]);

        // Test active scope
        $activeServices = Service::where('is_active', true)->get();
        $this->assertCount(1, $activeServices);
        $this->assertEquals('Active Service', $activeServices->first()->name);
    }

    /** @test */
    public function it_orders_by_sort_order()
    {
        // Create services with different sort orders
        $service3 = Service::create([
            'name' => 'Third Service',
            'description' => 'Third',
            'type' => 'airport',
            'base_price' => 50.00,
            'price_unit' => 'fixed',
            'is_active' => true,
            'sort_order' => 3,
        ]);

        $service1 = Service::create([
            'name' => 'First Service',
            'description' => 'First',
            'type' => 'business',
            'base_price' => 75.00,
            'price_unit' => 'hourly',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $service2 = Service::create([
            'name' => 'Second Service',
            'description' => 'Second',
            'type' => 'disposal',
            'base_price' => 100.00,
            'price_unit' => 'daily',
            'is_active' => true,
            'sort_order' => 2,
        ]);

        // Test ordering
        $orderedServices = Service::where('is_active', true)->orderBy('sort_order')->get();
        $this->assertEquals('First Service', $orderedServices[0]->name);
        $this->assertEquals('Second Service', $orderedServices[1]->name);
        $this->assertEquals('Third Service', $orderedServices[2]->name);
    }
}
