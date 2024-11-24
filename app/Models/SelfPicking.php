<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*
* Model for table self_picking
*/
class SelfPicking extends Model
{
    use HasFactory;

    protected $fillable = ['end_time', 'address', 'city', 'zip_code', 'product_id', 'user_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);  // 1:1 relationship with the product
    }

    // Connection with user(farmer) that start this self-picking
    public function farmer()
    {
        return $this->belongsTo(User::class, 'user_id');  
    }

    // Connection with customers, that added this self-picking to their events
    public function customers()
    {
        return $this->belongsToMany(User::class, 'self_picking_user'); 
    }
}
