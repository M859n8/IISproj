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
    //             $table->enum('status', ['self-storage', 'delegated'])->default('delegated'); // Самосбер або доручені
            $table->enum('status', ['processing', 'prepared', 'completed'])->default('processing'); // Стан замовлення
            $table->integer('quantity')->unsigned(); // Кількість одиниць продукту
            $table->timestamps();
    // Зовнішні ключі
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Це додає колонку product_id та зовнішній ключ
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
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
