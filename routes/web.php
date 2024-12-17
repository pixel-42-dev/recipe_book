<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\AdminController;

Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/search', [MainController::class, 'search'])->name('search');


Route::get('/ingredients', [IngredientController::class, 'view'])->name('ingredients');
Route::post('/ingredients/create', [IngredientController::class, 'create'])->name('ingredients.create');

Route::get('/recipes', [RecipeController::class, 'view'])->name('recipes');
Route::post('/recipes/create', [RecipeController::class, 'create'])->name('recipes.create');


Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::get('/admin/delete/{id}', [AdminController::class, 'deleteRecipe'])->name('admin.delete');


Route::middleware('admin.auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'viewDashboard'])->name('admin.dashboard');
});
