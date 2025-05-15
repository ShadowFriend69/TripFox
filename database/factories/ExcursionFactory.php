<?php

namespace Database\Factories;

use App\Models\ExcursionCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ExcursionFactory extends Factory
{

    /**
     * @inheritDoc
     */
    public function definition()
    {
        $title = fake()->sentence(3);
        return [
            'category_id' => ExcursionCategory::inRandomOrder()->first()->id,
            'guide_id' => User::where('role', 'guide')->inRandomOrder()->first()->id,
            'price' => fake()->randomFloat(0, 1000, 20000),
            'title' => $title,
            'slug' => Str::slug($title) . '-' . rand(100, 999),
            'preview_image' => 'excursions/default_preview.jpg',
            'detail_image' => 'excursions/default_detail.jpg',
            'preview_text' => fake()->text(100),
            'detail_text' => fake()->paragraph(10),
            'tags' => json_encode(fake()->words(3)),
            'duration_minutes' => fake()->randomNumber(3),
            'locations' => json_encode(fake()->words(5)),
            'language' => json_encode(fake()->words(2)),
            'max_people' => fake()->randomNumber(1),
            'transport' => fake()->word(),
            'isActive' => true,
            'published_at' => now(),
        ];
    }
}