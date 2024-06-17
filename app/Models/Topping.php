<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Topping extends Model
{
    use HasFactory;

    protected $table = 'toppings';

    protected $fillable = [
        'name',
        'image',
        'price',
    ];


    /**
     * Get all of the custom_cakes for the Topping
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function custom_cakes(): HasMany
    {
        return $this->hasMany(CustomCake::class, 'topping_id', 'id');
    }
}
