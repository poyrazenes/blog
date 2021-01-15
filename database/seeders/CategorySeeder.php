<?php

namespace Database\Seeders;

use App\Models\Category;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('tr_TR');

        Category::create([
            'parent_id' => null,
            'name' => 'Teknoloji',
            'slug' => 'teknoloji',
            'title' => $faker->sentence(3),
            'description' => $faker->paragraph
        ]);

        Category::create([
            'parent_id' => null,
            'name' => 'Sağlık',
            'slug' => 'saglik',
            'title' => $faker->sentence(3),
            'description' => $faker->paragraph
        ]);

        Category::create([
            'parent_id' => null,
            'name' => 'Medya',
            'slug' => 'medya',
            'title' => $faker->sentence(3),
            'description' => $faker->paragraph
        ]);

        Category::create([
            'parent_id' => null,
            'name' => 'Yazılım',
            'slug' => 'yazilim',
            'title' => $faker->sentence(3),
            'description' => $faker->paragraph
        ]);
    }
}
