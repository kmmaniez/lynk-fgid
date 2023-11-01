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
            for ($i=0; $i < 20; $i++) { 
                Transaction::create([
                    'product_id' => $product[rand(0, 19)]->id,
                    'duitku_order_id' => rand(500,1000) * rand(5,100) * rand(2,8) ,
                    'total_item' => rand(1,100),
                    'total_price' => rand(1,10) * rand(500,1000),
                    'customer_info' => $faker->name(),
                    'payment_method' => $payment[rand(0,2)],
                    // 'payment_status' => 'pending',
                    'payment_url' => $faker->url(),
                    'transaction_created' => $faker->dateTimeBetween('-1 week','now'),
                    // 'transaction_finished' => NULL,
                ]);
            }
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
