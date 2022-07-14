<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'level' => 'admin',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'member',
                'email' => 'member@gmail.com',
                'level' => 'member',
                'password' => bcrypt('123456'),
            ],
        ];
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}