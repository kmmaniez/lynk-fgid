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
        MasterPayoutDate::create([
            'initial_date' => date('2023-11-04')
        ]);
        $this->call([
            PermissionSeeder::class,
            UserSeeder::class,
            // ProductSeeder::class,
            // TransactionSeeder::class,
        ]);
    }
}
