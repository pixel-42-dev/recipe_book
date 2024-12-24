<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Recipes;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecipeUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function testRecipeDescriptionUpdate()
    {

        $recipe = Recipes::factory()->create([
            'description' => 'Old description',
        ]);

        $response = $this->post(route('admin.recipe.update', $recipe->id), [
            'description' => 'New description',
        ]);

        $response->assertRedirect(route('admin.dashboard'))
                 ->assertSessionHas('success', 'Описание рецепта обновлено!');

        $this->assertDatabaseHas('recipes', [
            'id' => $recipe->id,
            'description' => 'New description',
        ]);
    }
}
