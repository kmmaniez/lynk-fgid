<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignUlid('product_id')->constrained(); 
            $table->bigInteger('duitku_order_id');
            $table->string('duitku_reference');
            $table->integer('total_item');
            $table->integer('total_price');
            // $table->boolean('is_payout')->default(false);
            $table->string('customer_info')->nullable();
            $table->string('payment_method');
            $table->enum('payment_status',['pending','paid','expired'])->default('pending');
            // $table->string('payment_url')->nullable();
            $table->timestamp('transaction_created');
            $table->timestamp('transaction_finished')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
