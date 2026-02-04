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
        Schema::create('buyer_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('buyer_id');
            $table->foreign('buyer_id')->references('id')->on('buyers');
            $table->string('reoperty_type');
            $table->unsignedBigInteger('price');
            $table->string('request_type');
            $table->integer('bedrooms');
            $table->text('description');
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
        Schema::dropIfExists('buyer_requests');
    }
};
