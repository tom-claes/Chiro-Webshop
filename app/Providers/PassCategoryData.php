<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Product_category;

class PassCategoryData extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer(['site.shop.*', 'site.support.*'], function ($view) {
            $categories = Product_category::all();
            $view->with('categories', $categories);
        });
    }
}
