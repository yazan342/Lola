<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderCake extends Model
{
    use HasFactory;


    protected $table = 'order_cakes';


    protected $fillable = [
        'order_id',
        'cake_id',
        'quantity',
        'price', // store the price at the time of order
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function cake(): BelongsTo
    {
        return $this->belongsTo(Cake::class, 'cake_id');
    }
}
