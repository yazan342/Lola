<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CustomCake extends Model
{
    use HasFactory;

    protected $table = 'custom_cakes';

    protected $fillable = [
        'color_id',
        'shape_id',
        'topping_id',
        'flavor_id',
        'image',
        'text',
        'price',
    ];



    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function shape(): BelongsTo
    {
        return $this->belongsTo(Shape::class, 'shape_id');
    }

    public function topping(): BelongsTo
    {
        return $this->belongsTo(Topping::class, 'topping_id');
    }

    public function flavor(): BelongsTo
    {
        return $this->belongsTo(Flavor::class, 'flavor_id');
    }

    /**
     * Get all of the cartCakes for the CustomCake
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cart_custom_cakes(): HasMany
    {
        return $this->hasMany(CartCustomCake::class, 'custom_cake_id', 'id');
    }
}
