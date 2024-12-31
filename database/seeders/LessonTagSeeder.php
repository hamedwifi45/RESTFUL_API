<?php

namespace Database\Seeders;

use App\Models\Lessonstag as ModelsLessonstag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsLessonstag::factory()->count(10)->create();
    }
}
