<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ingredient_recipe extends Model
{
    use HasFactory;

    protected $table = 'ingredient_recipe';
    public $timestamps = true;
}
