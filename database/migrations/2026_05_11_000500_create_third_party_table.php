<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('third_party', function (Blueprint $table) {
            $table->id();
            $table->string('third_party_name');
            $table->foreignId('third_party_type')->constrained('vendor_type');
            $table->string('branch_name')->nullable();
            $table->string('vendor_code')->unique();
            $table->string('customer_code')->unique();
            $table->enum('vendor', ['yes', 'no'])->default('no');
            $table->enum('status', ['open', 'close'])->default('open');
            $table->foreignId('country')->constrained('countries');
            $table->foreignId('state')->constrained('states');
            $table->foreignId('city')->constrained('cities');
            $table->string('baecode')->nullable();
            $table->text('address')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('phone')->nullable();
            $table->string('web_url')->nullable();
            $table->enum('sales_tax', ['yes', 'no'])->default('no');
            $table->string('vat_id')->nullable();
            $table->foreignId('third_party_is')->constrained('third_party_is');
            $table->foreignId('work_force')->constrained('workforce');
            $table->foreignId('business_entity_type')->constrained('business_entity');
            $table->decimal('capital', 15, 2)->nullable();
            $table->string('logo')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('third_party');
    }
};
