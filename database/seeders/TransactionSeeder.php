<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = fake('id_ID');
        $payment = ['OV','SP','SA'];
        $product = Product::all();
        
        try {
            for ($i=0; $i < 10; $i++) { 
                Transaction::create([
                    'product_id' => $product[rand(0, $product->count() - 1)]->id,
                    'duitku_order_id' => rand(500,1000) * rand(5,100) * rand(2,8) ,
                    'duitku_reference' => 'DUITKU-'.rand(1,100) * rand(7,11) * rand(1,5),
                    'total_item' => rand(1,10),
                    'total_price' => rand(1,10) * 1000 * rand(3,7),
                    'customer_info' => $faker->email(),
                    'payment_method' => $payment[rand(0,2)],
                    'product_file_url' => $faker->url(),
                    // 'transaction_url_views' => 1,
                    'transaction_created' => $faker->dateTimeBetween('-2 week','now'),
                ]);
            }
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
