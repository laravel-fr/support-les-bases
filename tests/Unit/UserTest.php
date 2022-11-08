<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /** @test */
    public function can_be_admin()
    {
        $user = User::factory()->make(['role' => 'user']);
        $this->assertFalse($user->isAdmin());

        $owner = User::factory()->make(['role' => 'owner']);
        $this->assertFalse($owner->isAdmin());

        $admin = User::factory()->make(['role' => 'admin']);
        $this->assertTrue($admin->isAdmin());
    }

    /** @test */
    public function can_be_owner()
    {
        $user = User::factory()->make(['role' => 'user']);
        $this->assertFalse($user->isOwner());

        $owner = User::factory()->make(['role' => 'owner']);
        $this->assertTrue($owner->isOwner());

        $admin = User::factory()->make(['role' => 'admin']);
        $this->assertFalse($admin->isOwner());
    }
}
