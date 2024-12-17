<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ingredient_recipe;
use App\Models\ingredients;
use App\Models\Recipes;


class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function viewDashboard()
    {
        $recipes = Recipes::with('ingredients')->get();

        // Получаем ингредиенты, связанные с этими рецептами через таблицу ingredient_recipe
        $ingredientIds = ingredient_recipe::whereIn('recipes_id', $recipes->pluck('id'))->pluck('ingredients_id');
        $ingredients = ingredients::whereIn('id', $ingredientIds)->get();

        // Возвращаем данные в представление
        return view('admin.dashboard', [
            'recipes' => $recipes,
            'ingredients' => $ingredients,
            'ingredient_recipe' => $ingredientIds
        ]);

    }

    public function editRecipeForm($id)
    {
        $recipe = Recipes::findOrFail($id); // Находим рецепт по ID

        return view('recipe.edit', compact('recipe')); // Передаем рецепт в представление
    }


    public function updateRecipeDescription(Request $request, $id)
    {
        // Валидация данных формы
        $request->validate([
            'description' => 'required|string|max:255',
        ]);

        // Находим рецепт и обновляем поле description
        $recipe = Recipes::findOrFail($id);
        $recipe->description = $request->input('description');
        $recipe->save();

        // Перенаправляем с сообщением об успехе
        return redirect()->route('admin.dashboard')->with('success', 'Описание рецепта обновлено!');
    }

    public function deleteRecipe($id)
    {
        //Ищем рецепт по его id
        $recipe = Recipes::find($id);

        // Проверяем, найдена ли запись
        if (!$recipe) {
            return redirect()->route('admin.dashboard')->with('error', 'Рецепт не найден!');
        }

        //Удаляем запись
        $recipe->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Рецепт удален!');

    }

    public function deleteIngredient($recipeId, $ingredientId)
    {

        // Ищем запись в связующей таблице ingredient_recipe
        $ingredientRecipe = ingredient_recipe::where('recipes_id', $recipeId)
        ->where('ingredients_id', $ingredientId)
        ->first();

        // Проверяем, найдена ли запись
        if (!$ingredientRecipe) {
        return redirect()->route('admin.dashboard')->with('error', 'Ингредиент не найден!');
        }

        // Удаляем запись
        $ingredientRecipe->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Ингредиент удален!');

    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Проверяем логин и пароль
        if ($request->username === 'admin' && $request->password === 'admin') {
            session(['is_admin' => true]);
            return redirect()->route('admin.dashboard');
        }

        // Если данные неверны
        return back()->withErrors(['invalid' => 'Неправильный логин или пароль'])->withInput();
    }

    public function logout()
    {
        session()->forget('is_admin');
        return redirect()->route('admin.login');
    }
}
