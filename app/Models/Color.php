<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Color extends Model
{
    use HasFactory;

    protected $table = 'colors';

    protected $fillable = [
        'hex',
        'price',
    ];

    public function custom_cakes(): HasMany
    {
        return $this->hasMany(CustomCake::class, 'topping_id', 'id');
    }
}
