<?php

namespace Database\Factories;


use App\Models\Lesson;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lessonstag>
 */
class LessonstagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
            $les = Lesson::inRandomOrder()->get("id");
        $tag = Tag::inRandomOrder()->get('id');
        return [
            "lesson_id" => $les->first(),
            'tags_id' => $tag->first()
        ];
        
    }
}
