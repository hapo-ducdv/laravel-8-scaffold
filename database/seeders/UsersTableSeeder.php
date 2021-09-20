<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'fullname' => 'Hapo Tester',
            'username' => 'hapotester',
            'email' => 'test@haposoft.com',
            'role' => 1,
            'password' => bcrypt('12345678')
        ]);
    }
}
