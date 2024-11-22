<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','status', 'parent_id'];

    // Зв'язок з товарами (багато до багатьох)
    public function products()
    {
        // return $this->belongsToMany(Product::class);
        return $this->belongsToMany(Product::class, 'category_product');
        // return $this->hasMany(Product::class);
    }

    // Зв'язок з підкатегоріями
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Зв'язок з батьківською категорією
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
