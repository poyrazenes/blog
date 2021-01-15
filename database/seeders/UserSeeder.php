<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Enes',
            'last_name' => 'Poyraz',
            'email' => 'enes.poyraz@4alabs.io',
            'password' => bcrypt('asd123'),
            'is_admin' => true,
            'status' => true
        ]);
    }
}
