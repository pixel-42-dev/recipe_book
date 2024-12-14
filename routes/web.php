<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\RecipeController;

Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/search', [MainController::class, 'search'])->name('search');

Route::get('/ingredients', [IngredientController::class, 'view'])->name('ingredients');
Route::post('/ingredients/create', [IngredientController::class, 'create'])->name('ingredients.create');

Route::get('/recipes', [RecipeController::class, 'view'])->name('recipes');
Route::post('/recipes/create', [RecipeController::class, 'create'])->name('recipes.create');
