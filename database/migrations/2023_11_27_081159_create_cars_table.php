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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->text('Registration_Number')->unique()->nullable();
           
            $table->string('image')->nullable();
            $table->json('gallery_image')->nullable();
            $table->string('name');
            $table->string('brand');
            $table->string('badge')->nullable();
            $table->string('warranty')->nullable();
            $table->integer('free_service_count')->nullable();
            $table->string('location');
            $table->integer('car_age');
            $table->string('fuel_type');
            $table->integer('kilometers_driven');
            $table->bigInteger('cost_price');
            $table->bigInteger('sell_price');
            $table->string('color');
            $table->string('owners_count');
            $table->string('model');
            $table->string('body_type');
            $table->string('transmission');
            $table->string('status')->default('Not_Sold');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
