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
            'user_id' => 17,
            'AnimeName' => 'aaa' . Str::random(10),
            'status' => 'planned',
            'anime_feedback' => Str::random(10) . ' ' . Str::random(10),
        ]);
    }
}
