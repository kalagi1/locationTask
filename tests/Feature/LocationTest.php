<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class LocationTest extends TestCase
{
    public function test_get_locations(): void
    {
        $response = $this->get('/api/location');

        $response->assertStatus(200);
    }

    public function test_add_location(): void
    {
        Artisan::call('migrate:fresh');
        $response = $this->json('POST', '/api/location', [
            'name' => 'Test Location',
            'latitude' => 40.7128,
            'longitude' => -74.0060,
            "marker_color_hex" => 'f1f1f1',
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'name' => 'Test Location',
                     'latitude' => 40.7128,
                     'longitude' => -74.0060,
                     "marker_color_hex" => 'f1f1f1',
                 ]);

        $this->assertDatabaseHas('locations', [
            'name' => 'Test Location',
            'latitude' => 40.7128,
            'longitude' => -74.0060,
            "marker_color_hex" => 'f1f1f1',
        ]);
    }

    public function test_get_location_by_id() : void
    {
        $response = $this->get('/api/location/1');

        $response->assertStatus(201);
    }

    public function test_update_location_by_id() : void
    {
        $response = $this->json('PUT', '/api/location/1', [
            'name' => 'Updated Location',
            'latitude' => 41.0000,
            'longitude' => -75.0000,
            'marker_color_hex' => '000000',
        ]);
    
        $response->assertStatus(204);
    }

    public function test_delete_location_by_id() : void
    {
        $response = $this->json('DELETE', '/api/location/1');
    
        $response->assertStatus(204);
    }

    public function test_rotates() : void
    {
        $response = $this->json('GET', '/api/rotates', [
            'latitude' => -41.0000,
            'longitude' => -75.0000,
        ]);
    
        $response->assertStatus(200);
    }
}