<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','status', 'parent_id'];

    public function products()
    { //n-n with products
        return $this->belongsToMany(Product::class, 'category_product');
    }

    public function children()
    { //1-n with category
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    { //n-1 with category
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
