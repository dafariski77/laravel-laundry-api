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
                'username' => 'test1',
                'email' => 'test1@gmail.com',
                'password' => Hash::make('test123'),
            ],
        ];

        foreach ($users as $userItem) {
            User::create($userItem);
        }
    }
}
