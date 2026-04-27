<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'username' => 'admin',
                'role' => 'admin',
                'password' => Hash::make('101010'),
            ],

            [
                'name' => 'Petugas1',
                'email' => 'petugas1@gmail.com',
                'username' => 'petugas01',
                'role' => 'petugas',
                'password' => Hash::make('221008'),
            ],

            [
                'name' => 'Petugas2',
                'email' => 'petugas2@gmail.com',
                'username' => 'petugas02',
                'role' => 'petugas',
                'password' => Hash::make('111222'),
            ],
        ];

        foreach ($users as $user) {
           \App\Models\User::create($user);
        }
    }
}
