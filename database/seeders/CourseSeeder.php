<?php

namespace Database\Seeders;

use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::create([
            'name' => 'Hackathon DVC',
            'description' => '1-daagse hackathon voor IT docenten van het DVC.',
            'user_id' => 1,
            'date' => Carbon::now(),
        ]);
    }
}
