<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelfPicking extends Model
{
    use HasFactory;

    protected $fillable = ['end_time', 'address', 'city', 'zip_code', 'product_id', 'user_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);  // 1:1 зв'язок з продуктом
    }

    public function farmer()
    {
        return $this->belongsTo(User::class, 'farmer_id');  // Н:1 зв'язок з фермером (юзер)
    }

    public function customers()
    {
        return $this->belongsToMany(User::class, 'self_picking_user');  // Н:Н зв'язок з покупцями
    }
}
