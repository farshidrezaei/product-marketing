<?php

namespace App\Providers;

use App\Contracts\ProductLinkRepositoryContract;
use App\Contracts\ProductRepositoryContract;
use App\Repositories\ProductLinkRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductRepositoryContract::class,ProductRepository::class);
        $this->app->bind(ProductLinkRepositoryContract::class,ProductLinkRepository::class);
    }


}
