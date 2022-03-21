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
            'firstname' => $faker->firstName,
            'prefix' => $faker->word,
            'surname' => $faker->lastName,
            'uniqueCode' => '$2y$10$To0FS3UjCcEvQ.rAQ9g7We637CSmXWaLvao7oGJRy7S7rTzGKV3.S',
            'email' => 'admin@hackathon.nl',
            'password' => bcrypt('Welkom01'),
            'role_id' => 1,
        ]);
    }
}
