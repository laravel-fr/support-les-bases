<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_be_admin()
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->assertFalse($user->isAdmin());

        $owner = User::factory()->create(['role' => 'owner']);
        $this->assertFalse($owner->isAdmin());

        $admin = User::factory()->create(['role' => 'admin']);
        $this->assertTrue($admin->isAdmin());
    }

    /** @test */
    public function can_be_owner()
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->assertFalse($user->isOwner());

        $owner = User::factory()->create(['role' => 'owner']);
        $this->assertTrue($owner->isOwner());

        $admin = User::factory()->create(['role' => 'admin']);
        $this->assertFalse($admin->isOwner());
    }
}
