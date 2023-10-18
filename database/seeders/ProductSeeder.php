<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = fake('id_ID');

        for ($i=0; $i < 10; $i++) { 
            Product::create([
                'user_id' => rand(1,5),
                'name' => $faker->name(),
                'slug' => $faker->slug(),
                'thumbnail' => 'bg-3.jpg',
                'images' => 'user.jpg',
                'description' => $faker->text(30),
                'url' => $faker->url(),
                'min_price' => 500 * rand(10, 50),
                'max_price' => 1000 * rand(50, 100),
                'messages' => $faker->text(10),
            ]);
        }
    }
}
