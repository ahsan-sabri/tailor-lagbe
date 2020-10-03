<?php

use Illuminate\Database\Seeder;
use App\Models\Auth\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Administrator',
            'email' => 'admin@tailorlagbe.com',
            'mobile' => '+8801711000000',
            'user_type' => 'admin',
            'password' => bcrypt('password')
        ]);
    }
}
