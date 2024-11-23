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
        Schema::create('self_picking_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('self_picking_id');
            $table->unsignedBigInteger('user_id');  

            $table->foreign('self_picking_id')->references('id')->on('self_pickings')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('self_picking_user');
    }
};
