<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    // use HasFactory, Notifiable;
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

    public function selfpickings()
    {
        return $this->hasMany(SelfPicking::class);  // Н:1 зв'язок з self-picking (як фермер)
    }

    public function events()
    {
        return $this->belongsToMany(SelfPicking::class, 'self_picking_user');  // Н:Н зв'язок з self-picking (як покупець)
    }

}
