<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'category', 'category_id'];

    // Звязок з категорією
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
