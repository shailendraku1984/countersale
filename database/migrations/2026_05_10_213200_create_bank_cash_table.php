<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bank_cash', function (Blueprint $table) {
            $table->id();
            $table->string('ref')->unique();
            $table->string('bank_or_cash_label');
            $table->foreignId('account_type')->constrained('bank_account_type');
            $table->foreignId('currency')->constrained('currency');
            $table->enum('status', ['open', 'close'])->default('open');
            $table->foreignId('country')->constrained('countries');
            $table->foreignId('state')->constrained('states');
            $table->foreignId('city')->constrained('cities');
            $table->decimal('minimum_allowed_balance', 15, 2)->nullable();
            $table->decimal('minimum_desired_balance', 15, 2)->nullable();
            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('IBAN_account_number')->nullable();
            $table->string('SWIFT_code')->nullable();
            $table->text('bank_address')->nullable();
            $table->string('account_owner_name')->nullable();
            $table->text('account_owner_address')->nullable();
            $table->string('accounting_account')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bank_cash');
    }
};
