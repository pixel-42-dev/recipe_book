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
        // Получаем идентификаторы ингредиентов из запроса
        $ingredientIds = $request->input('ingredients');

        if ($ingredientIds) {
            // Поиск рецептов, которые содержат указанные ингредиенты
            $recipes = Recipes::with(['ingredients'])->get()->map(function($recipe) use ($ingredientIds) {
                // Получаем ингредиенты рецепта
                $recipeIngredients = $recipe->ingredients->pluck('id')->toArray();

                // Проверяем, какие ингредиенты присутствуют
                $presentIngredients = array_intersect($ingredientIds, $recipeIngredients);
                // Проверяем, какие ингредиенты отсутствуют
                $missingIngredients = array_diff($ingredientIds, $recipeIngredients);

                // Добавляем информацию о присутствующих и недостающих ингредиентах в рецепт
                $recipe->presentIngredients = $presentIngredients;
                $recipe->missingIngredients = $missingIngredients;

                return $recipe;
            });

            // Сортируем рецепты, чтобы те, у которых нет недостающих ингредиентов, отображались первыми
            $recipes = $recipes->sortBy(function($recipe) {
                return count($recipe->missingIngredients); // Сортируем по количеству недостающих ингредиентов
            });
        } else {
            // Если ингредиенты не переданы, возвращаем пустую коллекцию
            $recipes = collect();
        }

        // Возвращаем представление с найденными рецептами
        return view('recipe.view', compact('recipes'));
    }
}
