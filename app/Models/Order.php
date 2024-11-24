<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = ['product_id', 'user_id', 'status', 'quantity'];

 
    public function product()
    {
        return $this->belongsTo(Product::class);//n-1 with product
    }

    public function user()
    {
        return $this->belongsTo(User::class); //n-1 with user
    }

}
