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
        Schema::create('payments', function (Blueprint $table) {
            $table->payment_id();
            $table->foreignId('service_request_id')->constrained()->cascadeOnDelete();
            $table->float('amount');
            $table->string('status')->default('pending');
            $table->timestamp('paid_at')->nullable();
            $table->enum('payment_method', ['cash', 'omt', 'wishmoney', 'credit_card']);
            $table->string('transaction_id')->nullable();
            $table->string('payment_proof')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
