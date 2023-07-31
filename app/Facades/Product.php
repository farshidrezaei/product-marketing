<?php

namespace App\Facades;

use App\Contracts\ProductRepositoryContract;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Models\Product  show(int|string $productId);
 * @method static LengthAwarePaginator index(null|int $page = 1, null|int $perPage = 15):;
 * @method static \App\Models\Product  store(array $attributes);
 * @method static \App\Models\Product  update(\App\Models\Product $product, array $attributes);
 * @method static bool                 destroy(\App\Models\Product $product);
 *
 * @see ProductRepositoryContract
 */
class Product extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ProductRepositoryContract::class;
    }


    public static function showCached(...$args): \App\Models\Product
    {
        return Cache::remember(
            "products:$args[0]",
            now()->addMinutes(15),
            fn() => self::__callStatic('show', $args)
        );
    }

    public static function indexCached(...$args): LengthAwarePaginator
    {
        return Cache::remember(
            "products",
            now()->addMinutes(15),
            fn() => self::__callStatic('index', $args)
        );
    }

}