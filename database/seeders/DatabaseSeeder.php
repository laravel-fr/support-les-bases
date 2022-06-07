<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(1)->admin()->create([
            'email' => 'admin@example.net',
        ]);

        User::factory()->count(5)
            ->has(Restaurant::factory()->count(2))
            ->create();
    }
}
