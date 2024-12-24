<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\RecipeRepositoryInterface;
use App\Repositories\RecipeRepository;
use App\Repositories\IngredientRepositoryInterface;
use App\Repositories\IngredientRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RecipeRepositoryInterface::class, RecipeRepository::class);
        $this->app->bind(IngredientRepositoryInterface::class, IngredientRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
