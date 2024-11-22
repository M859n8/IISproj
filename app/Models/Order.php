<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// НЕ ПРОПИСАНІ ЗВЯЗКИ
class Order extends Model
{
    // use HasFactory; // Це створилося само не знаю що це

    protected $fillable = ['product_id', 'user_id', 'status', 'quantity'];

    // Зв’язок із продуктом
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Зв’язок із користувачем
    public function user()
    {
        return $this->belongsTo(User::class);
    }

//     // Можливі значення статусу
//     const TYPE_SELF_STORAGE = 'self-storage';
//     const TYPE_DELEGATED = 'delegated';
//
//     // Встановлення дефолтного значення для статусу
//     protected $attributes = [
//         'status' => self::TYPE_DELEGATED, // Дефолтне значення
//     ];
}
