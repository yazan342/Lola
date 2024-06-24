<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Flavor extends Model
{
    use HasFactory;

    protected $table = 'flavors';

    protected $fillable = [
        'name',
        'image',
        'price',

    ];


    public function custom_cakes(): HasMany
    {
        return $this->hasMany(CustomCake::class, 'flavor_id', 'id');
    }
}
