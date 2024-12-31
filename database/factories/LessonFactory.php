<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    protected $model = Lesson::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
public function definition(): array
{
    
        $user = User::inRandomOrder()->first();

    return [
        "user_id" => User::factory(),
        'title' => $this->faker->sentence(),
        'body' => $this->faker->realText(60),
        'created_at' => Carbon::now(),
        'updated_at'=> Carbon::now()
    ];
}
}
