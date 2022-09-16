<?php

namespace App\Providers;

use App\Repositories\Repository\CategoryRepository;
use App\Repositories\RepositoryInterface\CategoryRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public $bindings =[
        CategoryRepositoryInterface::class => CategoryRepository::class
    ];
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
