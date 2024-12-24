<?php

namespace Database\Factories;

use App\Models\Recipes;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecipesFactory extends Factory
{
    protected $model = Recipes::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
        ];
    }
}
