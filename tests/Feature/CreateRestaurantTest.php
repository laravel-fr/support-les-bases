<?php

namespace Tests\Feature;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateRestaurantTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function owner_can_create_restaurant()
    {
        $owner = User::factory()->create(['role' => 'owner']);

        $response = $this->actingAs($owner)->get('/restaurants/create');
        $response->assertSuccessful();

        $expectedAttributes = [
            'name' => 'O spaghetti',
            'type' => 'Italien',
            'address' => 'Petite place du centre ville',
        ];

        $response = $this->actingAs($owner)->post('/restaurants', $expectedAttributes);
        $response->assertRedirect('/restaurants/1');

        $expectedAttributes['user_id'] = $owner->id;

        $this->assertDatabaseHas(Restaurant::class, $expectedAttributes);
    }

    /** @test */
    public function guest_cant_create_restaurant()
    {
        $response = $this->get('/restaurants/create');
        $response->assertRedirect('/login');

        $response = $this->post('/restaurants', []);
        $response->assertRedirect('/login');

        $this->assertDatabaseCount(Restaurant::class, 0);
    }

    /** @test */
    public function user_cant_create_restaurant()
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get('/restaurants/create');
        $response->assertForbidden();

        $response = $this->actingAs($user)->post('/restaurants', []);
        $response->assertForbidden();

        $this->assertDatabaseCount(Restaurant::class, 0);
    }

    /** @test */
    public function admin_cant_create_restaurant()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/restaurants/create');
        $response->assertForbidden();

        $response = $this->actingAs($admin)->post('/restaurants', []);
        $response->assertForbidden();

        $this->assertDatabaseCount(Restaurant::class, 0);
    }
}
