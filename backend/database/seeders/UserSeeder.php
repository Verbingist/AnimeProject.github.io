<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([
            'name' => Str::random(10),
            'email' => Str::random(10),
            'phone' => Str::random(10),
            'password' => Str::random(20),
        ]);
    }
}
