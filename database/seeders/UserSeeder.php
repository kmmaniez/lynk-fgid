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

        for ($i=0; $i < 300; $i++) { 
            $users = User::create([
                'username'  => $faker->userName(),
                'name'      => $faker->name(),
                'email'     => $faker->email(),
                'description' => $faker->text('20'),
                'password'  => Hash::make('password')
            ]);
            $users->assignRole('creator');
        }

    }
}
