<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | User
            |--------------------------------------------------------------------------
            */

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            /*
            |--------------------------------------------------------------------------
            | Addresses
            |--------------------------------------------------------------------------
            */

            $table->foreignId('shipping_address_id')
                ->constrained('user_addresses')
                ->onDelete('cascade');

            $table->foreignId('billing_address_id')
                ->nullable()
                ->constrained('user_addresses')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Pricing
            |--------------------------------------------------------------------------
            */

            $table->decimal('subtotal', 12, 2)
                ->default(0);

            $table->decimal('tax_amount', 12, 2)
                ->default(0);

            $table->decimal('shipping_amount', 12, 2)
                ->default(0);

            $table->decimal('discount_amount', 12, 2)
                ->default(0);

            $table->decimal('grand_total', 12, 2)
                ->default(0);

            /*
            |--------------------------------------------------------------------------
            | Order Details
            |--------------------------------------------------------------------------
            */

            $table->string('order_number')
                ->unique();

            $table->enum('payment_method', [
                'cod',
                'online',
            ])->default('cod');

            $table->enum('payment_status', [
                'pending',
                'paid',
                'failed',
            ])->default('pending');

            $table->enum('order_status', [
                'pending',
                'confirmed',
                'processing',
                'shipped',
                'delivered',
                'cancelled',
            ])->default('pending');

            $table->text('notes')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};