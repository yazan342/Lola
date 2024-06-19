<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cake extends Model
{
    use HasFactory;
    protected $table = 'cakes';

    protected $fillable = [
        'name',
        'flavor',
        'image',
        'number_of_people',
        'price',
        'category_id',
    ];


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function cartCakes(): HasMany
    {
        return $this->hasMany(CartCake::class, 'cake_id');
    }

    public function orderCakes(): HasMany
    {
        return $this->hasMany(OrderCake::class, 'cake_id');
    }
}
