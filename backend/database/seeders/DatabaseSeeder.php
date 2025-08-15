<?php

namespace Database\Seeders;

use App\Models\Feedback;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // User::factory(10)->create();

        Feedback::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
