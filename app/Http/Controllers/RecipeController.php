<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipes;
use App\Models\ingredients;

class RecipeController extends Controller
{
    public function view()
    {
        $ingredients = ingredients::all();
        return view('recipe.create', compact('ingredients'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:recipes,name',
            'description' => 'required|string|max:1000',
            'ingredients' => 'required|array',
            'ingredients.*' => 'exists:ingredients,id'
        ]);        

        $recipe = Recipes::create([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        $recipe->ingredients()->attach($request->input('ingredients'));

        return redirect()->route('recipes')->with('success', 'Рецепт добавлен!');
    
    }
}
