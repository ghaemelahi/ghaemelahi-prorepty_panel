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
        Schema::create('building_buyers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('buyer_id');
            $table->foreign('buyer_id')->references('id')->on('buyers');
            $table->string('buyer_name');
            $table->string('buyer_phone');
            $table->unsignedBigInteger('request_seller_id');
            $table->foreign('request_seller_id')->references('id')->on('request_sellers');
            $table->string('created_at',60);
            $table->string('updated_at',60);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('building_buyers');
    }
};
