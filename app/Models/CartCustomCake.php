<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartCustomCake extends Model
{
    use HasFactory;

    protected $table = 'cart_custom_cakes';


    protected $fillable = [
        'cart_id',
        'custom_cake_id',
        'quantity',
    ];


    /**
     * Get the cart that owns the CartCustomCake
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }


    public function custom_cakes(): BelongsTo
    {
        return $this->belongsTo(CustomCake::class, 'custom_cake_id');
    }
}
