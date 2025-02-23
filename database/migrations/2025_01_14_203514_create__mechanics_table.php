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
        Schema::create('_mechanics', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name')->nullable(); 
            $table->integer('age')->nullable(); 
            $table->string('country')->nullable(); 
            $table->string('password')->nullable(); 
            $table->string('phone_number')->nullable(); 
            $table->string('location')->nullable();
            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_mechanics');
    }
};
