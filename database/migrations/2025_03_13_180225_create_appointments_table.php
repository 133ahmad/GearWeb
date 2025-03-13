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
       
            Schema::create('appointments', function (Blueprint $table) {
                $table->id();
                $table->foreignId('customer_id')->constrained()->onDelete('cascade');
                $table->foreignId('mechanic_id')->constrained()->onDelete('cascade');
                $table->dateTime('appointment_time');
                $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
                $table->timestamps();
            });
            
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
