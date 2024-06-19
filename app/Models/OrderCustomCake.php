<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderCustomCake extends Model
{
    use HasFactory;

    protected $table = 'order_custom_cakes';


    protected $fillable = [
        'order_id',
        'custom_cake_id',
        'quantity',
        'price', // store the price at the time of order
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function customCake(): BelongsTo
    {
        return $this->belongsTo(CustomCake::class, 'custom_cake_id');
    }
}
