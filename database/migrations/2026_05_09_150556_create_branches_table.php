<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('branches', function (
            Blueprint $table
        ) {

            $table->id();

            $table->string('branch_name');

            $table->text('address');

            $table->string('zipcode');

            $table->unsignedBigInteger('country_id');

            $table->unsignedBigInteger('state_id');

            $table->unsignedBigInteger('city_id');

            $table->softDeletes();

            $table->timestamps();

            $table->foreign('country_id')
                ->references('id')
                ->on('countries');

            $table->foreign('state_id')
                ->references('id')
                ->on('states');

            $table->foreign('city_id')
                ->references('id')
                ->on('cities');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};