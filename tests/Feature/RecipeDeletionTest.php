<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Recipes;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecipeDeletionTest extends TestCase
{
    use RefreshDatabase;

    public function test_recipe_can_be_deleted()
    {
        $recipe = Recipes::factory()->create();

        $response = $this->delete(route('admin.recipe.delete', $recipe->id));

        $response->assertRedirect(route('admin.dashboard'))
                 ->assertSessionHas('success', 'Рецепт удален!');

        $this->assertDatabaseMissing('recipes', ['id' => $recipe->id]);
    }

}

