<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = fake('id_ID');
        
        $this->call([
            // PermissionSeeder::class,
            // ProductSeeder::class,
            // TransactionSeeder::class,
        ]);
        for ($i=0; $i < 10; $i++) { 
            $users = User::create([
                'username'  => $faker->userName(),
                'name'      => $faker->name(),
                'email'     => $faker->email(),
                // 'phone' => $faker->phoneNumber(),
                'description' => $faker->paragraph('1'),
                'password'  => Hash::make('password')
            ]);
            $users->assignRole('creator');
        }
        // \App\Models\User::factory()->create([
        //      'name' => 'Admin',
        //      'email' => 'admin@gmail.com',
        // ]);

        // $this->call([
        //     ProductSeeder::class,
        // ]);
    }
}
