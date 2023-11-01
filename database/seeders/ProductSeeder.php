<?php

namespace Database\Seeders;

use App\Enums\CtaEnum;
use App\Enums\LayoutEnum;
use App\Enums\ProductTypeEnum;
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

        for ($i=0; $i < 20; $i++) { 
            Product::create([
                'user_id' => rand(1,10),
                'type' => ProductTypeEnum::PRODUCT_DIGITAL,
                'name' => $faker->name(),
                'slug' => $faker->slug(),
                // 'thumbnail' => 'bg-3.jpg',
                // 'images' => 'user.jpg',
                'description' => $faker->paragraph('3'),
                'url' => $faker->url(),
                'min_price' => 500 * rand(10, 50),
                'max_price' => 1000 * rand(50, 100),
                'messages' => $faker->paragraph(2),
                'cta_text' => CtaEnum::CTA_NO_OPTION
            ]);
        }
    }
}
