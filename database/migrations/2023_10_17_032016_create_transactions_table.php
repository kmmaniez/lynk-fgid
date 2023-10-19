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
            // $table->foreignUlid('product_id')->references('id')->on('products')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('total_item');
            $table->string('customer_email');
            $table->string('payment_options');
            $table->string('payment_status');
            $table->date('date_transaction');
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
