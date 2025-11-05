<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\EloquentProductRepository;
use App\Services\ProductServiceInterface;
use App\Services\ProductService;

class ProductServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ProductRepositoryInterface::class, EloquentProductRepository::class);
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
    }

    public function boot(): void
    {
        //
    }
}
