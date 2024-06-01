<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartCake extends Model
{
    use HasFactory;

    protected $table = 'cart_cakes';

    protected $fillable = [
        'cart_id',
        'cake_id',
        'quantity',
    ];



    /**
     * Get the cart that owns the CartCake
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function cake(): BelongsTo
    {
        return $this->belongsTo(Cake::class, 'cake_id');
    }
}
