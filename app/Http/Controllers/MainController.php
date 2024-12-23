<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ingredients;
use App\Models\Recipes;

class MainController extends Controller
{
    public function index()
    {
        $ingredients = ingredients::all();
        return view('index', compact('ingredients'));
    }

    public function search(Request $request)
    {
        $ingredientIds = $request->input('ingredients');
        if ($ingredientIds) {
            $recipes = Recipes::whereDoesntHave('ingredients', function ($query) use ($ingredientIds) {
                $query->whereNotIn('ingredients.id', $ingredientIds);
            })->get();
        } else {
            $recipes = collect();
        }

        return view('recipe.view', compact('recipes'));
    }
}
