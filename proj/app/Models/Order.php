<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// НЕ ПРОПИСАНІ ЗВЯЗКИ
class Order extends Model
{
    // use HasFactory; // Це створилося само не знаю що це

    protected $fillable = [
        'type'
    ];

    // Можливі значення статусу
    const TYPE_SELF_STORAGE = 'self-storage';
    const TYPE_DELEGATED = 'delegated';

    // Встановлення дефолтного значення для статусу
    protected $attributes = [
        'status' => self::TYPE_DELEGATED, // Дефолтне значення
    ];
}
