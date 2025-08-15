<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Feedback;
use Illuminate\Support\Str;

class FeedbackSeeder extends Seeder
{
    public function run(): void
    {
        Feedback::insert([
            'user_id' => 1,
            'AnimeName' => Str::random(10),
            'anime_feedback' => Str::random(20),
        ]);
    }
}
