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
        Schema::create('self_pickings', function (Blueprint $table) {
            $table->id();
            $table->dateTime('end_time');  // Час закінчення
            $table->string('address');  // Адреса
            $table->string('city')->nullable();  // Місто
            $table->integer('zip_code')->default(0);  // Поштовий індекс
            $table->unsignedBigInteger('product_id');  // Зовнішній ключ для зв'язку з продуктом
            $table->unsignedBigInteger('user_id');  // Зовнішній ключ для зв'язку з фермером (Юзер)
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
