<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('forPurchase', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->enum('status', ['open', 'close'])->default('open');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('forPurchase');
    }
};
