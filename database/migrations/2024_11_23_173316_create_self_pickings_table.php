<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/*
* Migration for table Self-picking
*/
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('self_pickings', function (Blueprint $table) {
            $table->id();
            $table->dateTime('end_time');  // End time of event
            $table->string('address');  
            $table->string('city')->nullable(); 
            $table->integer('zip_code')->default(0);  
            $table->unsignedBigInteger('product_id');  // Foreign key for linking with the product
            $table->unsignedBigInteger('user_id');  // Foreign key for linking with the farmer
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('self_pickings');
    }
};
