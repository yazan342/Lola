<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shape extends Model
{
    use HasFactory;

    protected $table = 'shapes';

    protected $fillable = [
        'name',
        'image',
        'price',

    ];

    public function custom_cakes(): HasMany
    {
        return $this->hasMany(CustomCake::class, 'topping_id', 'id');
    }
}
