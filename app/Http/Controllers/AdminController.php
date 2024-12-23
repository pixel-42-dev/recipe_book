<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipes;
use App\Repositories\RecipeRepositoryInterface;
use App\Repositories\IngredientRepositoryInterface;


class AdminController extends Controller
{
    protected $recipeRepository;
    protected $ingredientRepository;

    public function __construct(
        RecipeRepositoryInterface $recipeRepository,
        IngredientRepositoryInterface $ingredientRepository)
    {
        $this->recipeRepository = $recipeRepository;
        $this->ingredientRepository = $ingredientRepository;
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function viewDashboard()
    {
        $recipes = $this->recipeRepository->all();
        $ingredients = $this->ingredientRepository->all();

        return view('admin.dashboard', [
            'recipes' => $recipes,
            'ingredients' => $ingredients
        ]);
    }

    public function editRecipeForm($id)
    {
        $recipe = Recipes::findOrFail($id);

        return view('recipe.edit', compact('recipe'));
    }


    public function updateRecipeDescription(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string|max:255',
        ]);

        $recipe = Recipes::findOrFail($id);
        $recipe->description = $request->input('description');
        $recipe->save();

        return redirect()->route('admin.dashboard')->with('success', 'Описание рецепта обновлено!');
    }

    public function deleteRecipe($id)
    {
        $deleted = $this->recipeRepository->delete($id);

        if ($deleted) {
            return redirect()->route('admin.dashboard')->with('success', 'Рецепт удален!');
        } else {
            return redirect()->route('admin.dashboard')->with('error', 'Рецепт не найден!');
        }
    }

    public function deleteIngredient($recipeId, $ingredientId)
    {
        $this->ingredientRepository->deleteFromRecipe($recipeId, $ingredientId);
        return redirect()->route('admin.dashboard')->with('success', 'Ингредиент удален!');

    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($request->username === 'admin' && $request->password === 'admin') {
            session(['is_admin' => true]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['invalid' => 'Неправильный логин или пароль'])->withInput();
    }

    public function logout()
    {
        session()->forget('is_admin');
        return redirect()->route('admin.login');
    }
}
