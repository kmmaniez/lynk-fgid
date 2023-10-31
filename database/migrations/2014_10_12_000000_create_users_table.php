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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('email')->unique();
            $table->string('name')->nullable();
            $table->bigInteger('phone')->nullable();
            $table->string('coverimage')->nullable();
            $table->string('photo')->nullable();
            $table->string('description')->nullable();
            $table->enum('account_type',['standart','best'])->nullable();
            $table->enum('theme',['dark','light'])->default('light');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
