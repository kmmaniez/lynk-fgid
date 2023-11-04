<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\MasterPayoutDate;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = fake('id_ID');

        //
        $allDir = Storage::disk('public')->allDirectories();

        if (count($allDir) > 0) {
            for ($i=0; $i < count($allDir); $i++) { 
                try {
                    Storage::disk('public')->deleteDirectory($allDir[$i]);
                    Storage::disk('public')->deleteDirectory($allDir[$i]);
                    Storage::disk('public')->deleteDirectory($allDir[$i]);
                } catch (\Throwable $th) {
                    throw $th;
                }
            }
        }
        // MasterPayoutDate::create([
        //     'initial_date' => date('Y-m-d')
        // ]);
        $this->call([
            // PermissionSeeder::class,
            // ProductSeeder::class,
            // TransactionSeeder::class,
        ]);
        // for ($i=0; $i < 10; $i++) { 
        //     $users = User::create([
        //         'username'  => $faker->userName(),
        //         'name'      => $faker->name(),
        //         'email'     => $faker->email(),
        //         // 'phone' => $faker->phoneNumber(),
        //         'description' => $faker->paragraph('1'),
        //         'password'  => Hash::make('password')
        //     ]);
        //     $users->assignRole('creator');
        // }
    }
}
