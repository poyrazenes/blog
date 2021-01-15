<?php

namespace Database\Seeders;

use App\Models\Post;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('tr_TR');

        for ($i = 0; $i < 100; $i++) {
            Post::create([
                'user_id' => 1,
                'category_id' => rand(1, 4),
                'title' => $faker->sentence(5),
                'content' => $faker->paragraph(5),
                'status' => $faker->randomElement($array = array('0', '1'))
            ]);
        }
    }
}
