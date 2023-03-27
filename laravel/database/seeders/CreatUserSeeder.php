<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreatUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create user
        $users = [
            [
                "name" => "User",
                "email" => "user@gmail.com",
                "password" => bcrypt("123456"),
                "role" => 0,
            ],
            [
                "name" => "Editor",
                "email" => "editor@gmail.com",
                "password" => bcrypt("123456"),
                "role" => 1,
            ],
            [
                "name" => "Admin",
                "email" => "admin@gmail.com",
                "password" => bcrypt("123456"),
                "role" => 2,
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
