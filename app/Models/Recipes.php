<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipes extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function ingredients()
    {
        return $this->belongsToMany(ingredients::class, 'ingredient_recipe', 'recipes_id', 'ingredients_id');
    }
}
