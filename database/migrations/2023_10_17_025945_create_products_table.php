<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public const CTA = ['I Want this','Support Creator','Beli Sekarang','Book Now'];
    public const LAYOUT = ['default','grid','large'];
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name');
            $table->string('slug');
            $table->string('thumbnail')->nullable();
            $table->string('images')->nullable();
            $table->string('description')->nullable();
            $table->string('url')->nullable();
            $table->integer('min_price')->nullable();
            $table->integer('max_price')->nullable();
            $table->text('messages')->nullable();
            $table->enum('cta_text',[self::CTA])->default(self::CTA[0]);
            $table->enum('layout',[self::LAYOUT])->default(self::LAYOUT[0]);
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
