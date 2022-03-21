<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        User::create([
            'name' => $faker->name,
            'email' => 'admin@hackathon.nl',
            'password' => bcrypt('Welkom01'),
            'role_id' => 1,
        ]);
    }
}