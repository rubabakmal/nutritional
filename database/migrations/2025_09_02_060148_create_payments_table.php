<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');

            $table->string('payment_method'); // stripe, cod, bank_transfer
            $table->string('payment_intent_id')->nullable(); // For Stripe
            $table->string('transaction_id')->nullable(); // Generic transaction ID

            $table->decimal('amount', 10, 2);
            $table->string('currency', 3)->default('AED');

            $table->enum('status', ['pending', 'processing', 'completed', 'failed', 'cancelled', 'refunded']);

            // Payment gateway response data
            $table->json('gateway_response')->nullable();

            // Fees and charges
            $table->decimal('gateway_fee', 10, 2)->default(0);
            $table->decimal('net_amount', 10, 2); // Amount after fees

            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->index(['order_id', 'status']);
            $table->index('payment_intent_id');
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
