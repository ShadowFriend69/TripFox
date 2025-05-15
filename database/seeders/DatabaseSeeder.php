<?php

namespace Database\Seeders;

use App\Models\Excursion;
use App\Models\ExcursionCategory;
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

        ExcursionCategory::factory(5)->create();

        // Гиды
        $guides = User::factory(10)->guide()->create();

        // Клиенты
        User::factory(5)->client()->create();

        // Экскурсии
        $guides->each(function ($guide) {
            Excursion::factory(4)->create([
                'guide_id' => $guide->id
            ]);
        });
    }
}
