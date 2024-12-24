<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Recipes;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecipeValidationTest extends TestCase
{
    use RefreshDatabase;

    public function testRecipeDescriptionValidation()
    {

        $recipe = Recipes::factory()->create();

        $response = $this->post(route('admin.recipe.update', $recipe->id), [
            'description' => '', 
        ]);


        $response->assertSessionHasErrors('description');
    }
}

