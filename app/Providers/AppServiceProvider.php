<?php

namespace App\Providers;

use App\Repositories\Repository\BrandRepository;
use App\Repositories\Repository\CategoryRepository;
use App\Repositories\Repository\ProductRepository;
use App\Repositories\Repository\UserRepository;
use App\Repositories\RepositoryInterface\BrandRepositoryInterface;
use App\Repositories\RepositoryInterface\CategoryRepositoryInterface;
use App\Repositories\RepositoryInterface\ProductRepositoryInterface;
use App\Repositories\RepositoryInterface\UserRepositoryInterface;
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
        CategoryRepositoryInterface::class => CategoryRepository::class,
        BrandRepositoryInterface::class => BrandRepository::class,
        ProductRepositoryInterface::class => ProductRepository::class,
        UserRepositoryInterface::class => UserRepository::class
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
