<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;
use App\Tag;
use Illuminate\Support\Collection;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Add the categories and the tags to all views
         */
        view()->share('categories', Category::withCount('products')->get() );
        view()->share('tags', Tag::withCount('products')->get() );

        /**
         * Add the custom method to get most used tags and categories
         */
        Collection::macro('getMostUsed', function ( int $num = 10 ){
            return $this->sortByDesc('products_count')->take($num);
        });
        /**
         * Add the custom method to get the most recent tags and categories
         */
        Collection::macro('getMostRecent', function ( int $num = 10 ){
            return $this->sortByDesc('updated_at')->take($num);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
