<?php

namespace Tests\Feature;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditRestaurantTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function owner_can_edit_his_restaurant()
    {
        $owner = User::factory()->create(['role' => 'owner']);
        $restaurant = Restaurant::factory()
            ->for($owner)
            ->create();

        $response = $this->actingAs($owner)->get('/restaurants/' . $restaurant->id . '/edit');
        $response->assertSuccessful();

        $expectedAttributes = [
            'name' => 'NEW !! O spaghetti',
            'type' => 'Italien',
            'address' => 'Petite place du centre ville',
        ];

        $response = $this->actingAs($owner)->put('/restaurants/' . $restaurant->id, $expectedAttributes);
        $response->assertRedirect('/restaurants/' . $restaurant->id);

        $expectedAttributes['user_id'] = $owner->id;

        $this->assertDatabaseHas(Restaurant::class, $expectedAttributes);
    }

    /** @test */
    public function other_owner_cant_edit_your_restaurant()
    {
        $otherOwner = User::factory()->create(['role' => 'owner']);
        $owner = User::factory()->create(['role' => 'owner']);
        $restaurant = Restaurant::factory()
            ->for($owner)
            ->create();

        $response = $this->actingAs($otherOwner)->get('/restaurants/' . $restaurant->id . '/edit');
        $response->assertForbidden();

        $response = $this->actingAs($otherOwner)->put('/restaurants/' . $restaurant->id, []);
        $response->assertForbidden();
    }

    /** @test */
    public function guest_cant_edit_restaurant()
    {
        $owner = User::factory()->create(['role' => 'owner']);
        $restaurant = Restaurant::factory()
            ->for($owner)
            ->create();

        $response = $this->get('/restaurants/' . $restaurant->id . '/edit');
        $response->assertRedirect('/login');

        $response = $this->put('/restaurants/' . $restaurant->id, []);
        $response->assertRedirect('/login');
    }

    /** @test */
    public function user_cant_edit_restaurant()
    {
        $user = User::factory()->create(['role' => 'user']);
        $owner = User::factory()->create(['role' => 'owner']);
        $restaurant = Restaurant::factory()
            ->for($owner)
            ->create();

        $response = $this->actingAs($user)->get('/restaurants/' . $restaurant->id . '/edit');
        $response->assertForbidden();

        $response = $this->actingAs($user)->put('/restaurants/' . $restaurant->id, []);
        $response->assertForbidden();
    }

    /** @test */
    public function admin_cant_edit_restaurant()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $owner = User::factory()->create(['role' => 'owner']);
        $restaurant = Restaurant::factory()
            ->for($owner)
            ->create();

        $response = $this->actingAs($admin)->get('/restaurants/' . $restaurant->id . '/edit');
        $response->assertForbidden();

        $response = $this->actingAs($admin)->put('/restaurants/' . $restaurant->id, []);
        $response->assertForbidden();
    }
}
