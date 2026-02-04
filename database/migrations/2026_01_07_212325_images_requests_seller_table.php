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
        Schema::create('images_requests_seller', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('request_seller_id');
            $table->foreign('request_seller_id')->references('id')->on('requests_sellers');
            $table->text('path');
            $table->tinyInteger('is_deleted')->default(0);
            $table->string('created_at',60);
            $table->string('updated_at',60);
            $table->string('delete_at',60)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images_requests_seller');
    }
};
