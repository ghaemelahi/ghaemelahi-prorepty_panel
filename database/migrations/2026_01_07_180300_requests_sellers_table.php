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
        Schema::create('request_sellers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seller_id');
            $table->foreign('seller_id')->references('id')->on('sellers');
            $table->string('reoperty_type');
            $table->string('request_type');
            $table->string('dimensions_building');
            $table->string('meterage_building');
            $table->string('year_manufacture');
            $table->string('document_type');
            $table->unsignedBigInteger('price');
            $table->string('options');
            $table->integer('number_bedrooms');
            $table->tinyInteger('water');
            $table->tinyInteger('electric');
            $table->tinyInteger('gas');
            $table->tinyInteger('telephone');
            $table->text('address');
            $table->text('description');
            $table->enum('status',['doing','compelet'])->default('doing');
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
        Schema::dropIfExists('request_sellers');
    }
};
