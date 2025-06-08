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
            'email' => 'arief.rahman@mail.com',
            'contact_number' => '080101010101',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'id' => '2',
            'username' => 'alexandersartono',
            'fullname' => 'Alexander Sartono',
            'email' => 'alexander.sartono@mail.com',
            'contact_number' => '080202020202',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'id' => '3',
            'username' => 'monicadestianti',
            'fullname' => 'Monica Destianti',
            'email' => 'monica.destianti@mail.com',
            'contact_number' => '080303030303',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'id' => '4',
            'username' => 'oliverleon',
            'fullname' => 'Oliver Leon',
            'email' => 'oliver.leon@mail.com',
            'contact_number' => '080404040404',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'id' => '5',
            'username' => 'rifqinugraha',
            'fullname' => 'Rifqi Nugraha',
            'email' => 'rifqi.nugraha@mail.com',
            'contact_number' => '080505050505',
            'password' => Hash::make('password123'),
        ]);
    }
}
