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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique(); // Readable order number like ORD-2025-001
            $table->string('session_id');
            $table->string('payment_intent_id')->nullable();
            $table->enum('payment_method', ['stripe', 'cod', 'bank_transfer'])->default('cod');
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'refunded'])->default('pending');
            $table->enum('order_status', ['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled'])->default('pending');

            // Contact Information
            $table->string('customer_email');
            $table->string('customer_phone');

            // Pricing
            $table->decimal('subtotal', 10, 2);
            $table->decimal('shipping_cost', 10, 2)->default(0);
            $table->decimal('tax_amount', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2);
            $table->string('currency', 3)->default('AED');

            // Order notes
            $table->text('notes')->nullable();
            $table->text('admin_notes')->nullable();

            $table->timestamps();

            $table->index(['session_id', 'order_status']);
            $table->index('payment_intent_id');
            $table->index('order_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
