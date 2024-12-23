<?php

namespace App\Repositories;

use App\Models\Recipes;
use Illuminate\Support\Collection;

class RecipeRepository implements RecipeRepositoryInterface
{
    public function all(): Collection
    {
        return Recipes::all();
    }

    public function find(int $id): Recipes
    {
        return Recipes::findOrFail($id);
    }

    public function create(array $data): Recipes
    {
        return Recipes::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $recipe = $this->find($id);
        return $recipe->update($data);
    }

    public function delete(int $id): bool
    {
        $recipe = $this->find($id);
        return $recipe->delete();
    }
}
