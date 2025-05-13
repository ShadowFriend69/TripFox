<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ExcursionCategoryFactory extends Factory
{

    /**
     * @inheritDoc
     */
    public function definition()
    {
        $title = fake()->unique()->word();
        return [
            'title' => ucfirst($title),
            'slug' => Str::slug($title),
            'isActive' => true,
        ];
    }
}