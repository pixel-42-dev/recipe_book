<?php

namespace App\Repositories;

use App\Models\Ingredients;
use Illuminate\Support\Collection;

interface IngredientRepositoryInterface
{
    public function all(): Collection;
    public function find(int $id): Ingredients;
    public function create(array $data): Ingredients;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}
