<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Recipes;
use App\Models\ingredients;
use App\Models\ingredient_recipe;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IngredientDeletionTest extends TestCase
{
    use RefreshDatabase;

    public function test_ingredient_can_be_deleted_from_recipe()
    {
        $recipe = Recipes::factory()->create();
        $ingredient = ingredients::factory()->create();
        $relation = ingredient_recipe::create([
            'recipes_id' => $recipe->id,
            'ingredients_id' => $ingredient->id,
        ]);

        $response = $this->delete(route('admin.ingredient.delete', [
            'recipeId' => $recipe->id,
            'ingredientId' => $ingredient->id,
        ]));

        $response->assertRedirect(route('admin.dashboard'))
                 ->assertSessionHas('success', 'Ингредиент удален!');

        $this->assertDatabaseMissing('ingredient_recipe', [
            'recipes_id' => $recipe->id,
            'ingredients_id' => $ingredient->id,
        ]);
    }
}
