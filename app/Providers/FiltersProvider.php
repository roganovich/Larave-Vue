<?php

namespace App\Providers;

use App\Http\Resources\Point\PointResourceCollection;
use App\Models\Point;
use App\Models\ProductsCategory;
use Illuminate\Support\ServiceProvider;

class FiltersProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('pointsCities', function ($app) {
            return new PointResourceCollection(Point::cityes()->get());
        });
        $this->app->singleton('pointsTypes', function ($app) {
            return new PointResourceCollection(Point::types()->get());
        });
        $this->app->singleton('productsCategories', function ($app) {
            return ProductsCategory::select(['id', 'title', 'slug'])->get();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['pointsCities', 'pointsTypes', 'productsCategories'];
    }
}
