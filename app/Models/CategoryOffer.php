<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// НЕ ПРОПИСАНІ ЗВЯЗКИ
class CategoryOffer extends Model
{
    // Якщо не стандартна назва - прописуємо її про всяк випадок
    protected $table = 'category_offers';
    // use HasFactory;
    protected $fillable = [
        'name'
    ];
}
