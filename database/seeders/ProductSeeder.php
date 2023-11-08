<?php

namespace Database\Seeders;

use App\Enums\CtaEnum;
use App\Enums\LayoutEnum;
use App\Enums\ProductTypeEnum;
use App\Models\Product;
use App\Models\User;
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
        $user = User::all();
        for ($i = 0; $i < 100; $i++) {
            Product::create([
                'user_id' => $user[rand(0, $user->count() - 1)]->id,
                'name' => $faker->word(),
                'type' => ProductTypeEnum::PRODUCT_DIGITAL,
                'slug' => $faker->slug(),
                'description' => $faker->text(15),
                'url' => $faker->url(),
                'min_price' => 500 * rand(10, 50),
                'recommend_price' => 1000 * rand(50, 100),
                'messages' => $faker->paragraph(2),
                'cta_text' => CtaEnum::CTA_NO_OPTION
            ]);
        }
    }
}
