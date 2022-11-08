<?php

namespace Tests\Feature;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteRestaurantTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function owner_can_delete_his_restaurant()
    {
        $owner = User::factory()->create(['role' => 'owner']);
        $restaurant = Restaurant::factory()
            ->for($owner)
            ->create();

        $response = $this->actingAs($owner)->delete('/restaurants/' . $restaurant->id);
        $response->assertRedirect('/restaurants');

        $this->assertDatabaseMissing(Restaurant::class, ['id' => $restaurant->id]);
    }

        /** @test */
    public function other_owner_cant_edit_your_restaurant()
    {
        $otherOwner = User::factory()->create(['role' => 'owner']);
        $owner = User::factory()->create(['role' => 'owner']);
        $restaurant = Restaurant::factory()
            ->for($owner)
            ->create();

        $response = $this->actingAs($otherOwner)->delete('/restaurants/' . $restaurant->id);
        $response->assertForbidden();

        $this->assertDatabaseHas(Restaurant::class, ['id' => $restaurant->id]);
    }

    /** @test */
    public function guest_cant_edit_restaurant()
    {
        $owner = User::factory()->create(['role' => 'owner']);
        $restaurant = Restaurant::factory()
            ->for($owner)
            ->create();

        $response = $this->delete('/restaurants/' . $restaurant->id);
        $response->assertRedirect('/login');

        $this->assertDatabaseHas(Restaurant::class, ['id' => $restaurant->id]);
    }

    /** @test */
    public function user_cant_edit_restaurant()
    {
        $user = User::factory()->create(['role' => 'user']);
        $owner = User::factory()->create(['role' => 'owner']);
        $restaurant = Restaurant::factory()
            ->for($owner)
            ->create();

        $response = $this->actingAs($user)->delete('/restaurants/' . $restaurant->id);
        $response->assertForbidden();

        $this->assertDatabaseHas(Restaurant::class, ['id' => $restaurant->id]);
    }

    /** @test */
    public function admin_cant_edit_restaurant()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $owner = User::factory()->create(['role' => 'owner']);
        $restaurant = Restaurant::factory()
            ->for($owner)
            ->create();

        $response = $this->actingAs($admin)->delete('/restaurants/' . $restaurant->id);
        $response->assertRedirect('/restaurants');

        $this->assertDatabaseMissing(Restaurant::class, ['id' => $restaurant->id]);
    }
}
