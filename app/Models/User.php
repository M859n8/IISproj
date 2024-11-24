<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
/*
* Model for table user
*/
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'surname',
        'name',
        'email',
        'password',
        'role',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Connection between farmer and self-picking
    public function selfpickings()
    {
        return $this->hasMany(SelfPicking::class);  
    }

    // Connection between customer and self-picking
    public function events()
    {
        return $this->belongsToMany(SelfPicking::class, 'self_picking_user');  
    }

}
