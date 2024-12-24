<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ingredient_recipe extends Model
{
    use HasFactory;

    protected $table = 'ingredient_recipe';
    protected $fillable = [
        'recipes_id',
        'ingredients_id',
    ];
    public $timestamps = true;
}
