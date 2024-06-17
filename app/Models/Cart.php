<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';

    protected $fillable = [
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    /**
     * Get all of the comments for the Cart
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cartCakes(): HasMany
    {
        return $this->hasMany(CartCake::class, 'cart_id');
    }


    public function cartCustomCakes(): HasMany
    {
        return $this->hasMany(CartCustomCake::class, 'cart_id');
    }
}
