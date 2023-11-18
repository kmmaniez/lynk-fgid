<?php

use App\Enums\CtaEnum;
use App\Enums\LayoutEnum;
use App\Enums\ProductTypeEnum;
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
        Schema::create('products', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUuid('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name');
            $table->string('type')->default(ProductTypeEnum::PRODUCT_LINK->value);
            $table->string('slug')->nullable();
            $table->string('thumbnail')->nullable();
            $table->longText('images')->nullable();
            $table->string('description')->nullable();
            $table->string('url')->nullable();
            $table->integer('min_price')->nullable();
            $table->integer('recommend_price')->nullable();
            $table->text('messages')->nullable();
            $table->string('cta_text')->nullable();
            $table->string('layout')->default(LayoutEnum::LAYOUT_DEFAULT->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
