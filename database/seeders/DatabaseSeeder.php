<?php

namespace Database\Seeders;

use App\Models\Excursion;
use App\Models\ExcursionCategory;
use App\Models\Guide;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);

        // Категории
        ExcursionCategory::factory(5)->create();

        // Гиды с пользователями
        Guide::factory(10)->create()->each(function ($guide) {
            // У каждого гида 4 экскурсии
            Excursion::factory(4)->create([
                'guid_id' => $guide->id
            ]);
        });
    }
}
