<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Recipes;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecipeEditFormTest extends TestCase
{
    use RefreshDatabase;

    public function testRecipeEditFormIsAccessible()
    {
        $recipe = Recipes::factory()->create();

        $response = $this->get(route('admin.recipe.edit', $recipe->id));

        $response->assertStatus(200)
                 ->assertViewIs('recipe.edit')
                 ->assertViewHas('recipe', $recipe)
                 ->assertSee($recipe->description);

    }
}

