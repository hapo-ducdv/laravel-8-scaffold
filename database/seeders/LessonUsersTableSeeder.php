<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LessonUser;

class LessonUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LessonUser::factory()->count(300)->create();
    }
}
