<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description','quantity', 'rating_sum', 'rating_count', 'price'];

    // Звязок з категорією
    public function category()
    {
        return $this->belongsToMany(Category::class, 'category_product');
        // return $this->belongsTo(Category::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}