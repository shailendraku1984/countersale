<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category')->constrained('categories');
            $table->foreignId('branch')->constrained('branches');
            $table->foreignId('warehouse')->constrained('warehouses');
            $table->foreignId('forSale')->constrained('forSale');
            $table->foreignId('forPurchase')->constrained('forPurchase');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 15, 2);
            $table->unsignedInteger('stock');
            $table->foreignId('tax_rate')->constrained('tax_rate');
            $table->foreignId('product_color')->nullable()->constrained('product_color')->nullOnDelete();
            $table->foreignId('product_size')->nullable()->constrained('product_size')->nullOnDelete();
            $table->string('image')->nullable();
            $table->enum('status', ['open', 'close'])->default('open');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
