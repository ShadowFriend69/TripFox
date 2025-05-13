<?php

namespace Database\Factories;

use App\Models\ExcursionCategory;
use App\Models\Guide;
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
            'guid_id' => Guide::inRandomOrder()->first()->id,
            'title' => $title,
            'slug' => Str::slug($title) . '-' . rand(100, 999),
            'preview_image' => 'excursions/default_preview.jpg',
            'detail_image' => 'excursions/default_detail.jpg',
            'preview_text' => fake()->text(100),
            'detail_text' => fake()->paragraph(10),
            'tags' => json_encode(fake()->words(3)),
            'isActive' => true,
            'published_at' => now(),
        ];
    }
}