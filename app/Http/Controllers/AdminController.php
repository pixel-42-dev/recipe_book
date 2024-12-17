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
        //$recipes = Recipes::all(); // Получаем все рецепты
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

    public function showRecipe($id)
    {
        $ingridients = new ingredients_recipe;
        return view('search', ['data' => $ingridients->find($id)]);
    }

    public function deleteRecipe($id)
    {
        $recipe = Recipes::find($id);

        if (!$recipe) {
            return redirect()->route('admin.dashboard')->with('error', 'Рецепт не найден!');
        }

        $recipe->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Рецепт удален!');

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
