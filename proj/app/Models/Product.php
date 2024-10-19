<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'category'];

    // Звязок з категорією
    public function category()
    {
        return $this->belongsToMany(Category::class, 'category_product');
        // return $this->belongsTo(Category::class);
    }
}
