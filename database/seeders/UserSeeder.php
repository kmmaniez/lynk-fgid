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
        $faker = fake('id_ID');

        $data = [
            [
                'username'  => 'writer',
                'name'      => 'Creator Program',
                'email'     => 'writer@gmail.com',
                'role'      => ['creator'],
            ],
            [
                'username'  => 'adminlorem',
                'name'      => 'Name ADMIN FGID',
                'email'     => 'admin@gmail.com',
                'role'      => ['admin'],
            ],
        ];

        foreach ($data as $row) {
            try {
                $user = User::create([
                    'username'  => $row['username'],
                    'name'      => $row['name'],
                    'email'     => $row['email'],
                    'password'  => Hash::make('password')
                ]);
                $user->assignRole($row['role']);
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        for ($i=0; $i < 10; $i++) { 
            $users = User::create([
                'username'  => $faker->userName(),
                'name'      => $faker->name(),
                'email'     => $faker->email(),
                'phone' => $faker->phoneNumber(),
                'description' => $faker->paragraph('2'),
                'password'  => Hash::make('password')
            ]);
            $users->assignRole('writer');
        }

    }
}
