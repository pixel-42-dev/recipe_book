<?php

namespace App\Repositories;

use App\Models\Recipes;
use Illuminate\Support\Collection;

interface RecipeRepositoryInterface
{
    public function all(): Collection;
    public function find(int $id): Recipes;
    public function create(array $data): Recipes;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}
