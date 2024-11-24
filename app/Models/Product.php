<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description','quantity','unit', 'rating_sum', 'rating_count', 'price'];

    public function category()
    {
        return $this->belongsToMany(Category::class, 'category_product'); //n-n with category
    }
    public function orders()
    {
        return $this->hasMany(Order::class);//1-n with orders
    }

    public function user()
    {
        return $this->belongsTo(User::class); //n-1 with user
    }

    public function selfPicking()
    {
        return $this->hasOne(SelfPicking::class);  // 1-1  with self-picking
    }

}
