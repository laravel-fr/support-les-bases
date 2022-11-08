<?php

namespace Tests\Feature;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowRestaurantTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_view_restaurant_list()
    {
        $owner = User::factory()->create(['role' => 'owner']);
        Restaurant::factory()
            ->for($owner)
            ->count(3)
            ->create();

        $response = $this->get('/restaurants');

        $response->assertSuccessful();

        $this->assertCount(3, $response['restaurants']);
        $this->assertContainsOnlyInstancesOf(Restaurant::class, $response['restaurants']);
    }

    /** @test */
    public function guest_can_view_specific_restaurant()
    {
        $owner = User::factory()->create(['role' => 'owner']);
        $restaurant = Restaurant::factory()
            ->for($owner)
            ->create();

        $response = $this->get('/restaurants/' . $restaurant->id);

        $response->assertSuccessful();

        $this->assertInstanceOf(Restaurant::class, $response['restaurant']);
        $this->assertEquals($restaurant->name, $response['restaurant']->name);
    }
}
