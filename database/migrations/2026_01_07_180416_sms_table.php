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
        Schema::create('sms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->integer('count');
            $table->tinyInteger('status');
            $table->text('text');
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
        Schema::dropIfExists('sms');
    }
};
