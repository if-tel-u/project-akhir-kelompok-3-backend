<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'id' => '1',
            'username' => 'ariefrahman',
            'fullname' => 'Arief Rahman',
            'email' => 'john.doe@mail.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'id' => '2',
            'username' => 'alexandersartono',
            'fullname' => 'Alexander Sartono',
            'email' => 'alexander.sartono@mail.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'id' => '3',
            'username' => 'monica_destianti',
            'fullname' => 'Monica Destianti',
            'email' => 'monica.destianti@mail.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'id' => '4',
            'username' => 'oliver_leon',
            'fullname' => 'Oliver Leon',
            'email' => 'oliver.leon@mail.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'id' => '5',
            'username' => 'rifqi_nugraha',
            'fullname' => 'Rifqi Nugraha',
            'email' => 'rifqi.nugraha@mail.com',
            'password' => Hash::make('password123'),
        ]);
    }
}
