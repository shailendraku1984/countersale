<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run migrations.
     */
    public function up(): void
    {
        Schema::create('warehouses', function (Blueprint $table) {

            $table->id();

            $table->string('warehouse_name');

            $table->text('description')->nullable();

            $table->enum('status', ['open', 'close'])
                ->default('open');

            $table->text('address');

            $table->string('zipcode', 20);

            $table->string('phone', 20);

            $table->foreignId('country_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('state_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('city_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouses');
    }
};