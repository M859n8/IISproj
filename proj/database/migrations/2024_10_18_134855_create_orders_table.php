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
        // НЕ ПРОПИСАНІ ЗВЯЗКИ
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['self-storage', 'delegated'])->default('delegated'); // Самосбер або доручені
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
