<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';


    protected $fillable = [
        'user_id',
        'total_price',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderCakes(): HasMany
    {
        return $this->hasMany(OrderCake::class, 'order_id');
    }

    public function orderCustomCakes(): HasMany
    {
        return $this->hasMany(OrderCustomCake::class, 'order_id');
    }
}
