<?php

namespace App\Repositories;

use App\Models\Ingredients;
use Illuminate\Support\Collection;
use App\Models\ingredient_recipe;

class IngredientRepository implements IngredientRepositoryInterface
{
    public function all(): Collection
    {
        return Ingredients::all();
    }

    public function find(int $id): Ingredients
    {
        return Ingredients::findOrFail($id);
    }

    public function create(array $data): Ingredients
    {
        return Ingredients::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $ingredient = $this->find($id);
        return $ingredient->update($data);
    }

    public function delete(int $id): bool
    {
        $ingredient = $this->find($id);
        return $ingredient->delete();
    }

    public function deleteFromRecipe(int $recipeId, int $ingredientId) {
        $ingredientRecipe = ingredient_recipe::where('recipes_id', $recipeId)
            ->where('ingredients_id', $ingredientId)
            ->first();

        if (!$ingredientRecipe) {
        return redirect()->route('admin.dashboard')->with('error', 'Ингредиент не найден!');
        }

        $ingredientRecipe->delete();
    }
}
