<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class GuideFactory extends Factory
{

    /**
     * @inheritDoc
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
        ];
    }
}