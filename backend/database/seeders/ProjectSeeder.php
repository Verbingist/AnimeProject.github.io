<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use app\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        // Project::insert([
        //     'projectName' => Str::random(10),
        //     'projectHref' => Str::random(10),
        // ]);
        DB::table('projects')->insert([
            'projectName' => Str::random(10),
            'projectHref' => Str::random(10),
        ]);
    }
}
