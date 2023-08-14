<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                "role_id" => 1
            ],
            [
                'username' => 'owner',
                'email' => 'owner@gmail.com',
                'password' => Hash::make('owner'),
                "role_id" => 2
            ],
        ];

        foreach ($users as $userItem) {
            User::create($userItem);
        }
    }
}
