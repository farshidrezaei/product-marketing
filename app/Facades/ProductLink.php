<?php

namespace App\Facades;

use App\Contracts\ProductLinkRepositoryContract;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Models\ProductLink  show(int|string $productId, int|string $productLinkId);
 * @method static \App\Models\ProductLink  findBySlug(string $slug);
 * @method static LengthAwarePaginator     index(int|string $productLinkId, null|int $page = 1, null|int $perPage = 15):;
 * @method static \App\Models\Product      store(int|string $productId, string $slug);
 * @method static \App\Models\Product      update(\App\Models\ProductLink $productLink, string $slug);
 * @method static bool                     destroy(\App\Models\ProductLink $productLink);
 *
 * @see ProductLinkRepositoryContract
 */
class ProductLink extends Facade
{

    protected static function getFacadeAccessor(): string
    {
        return ProductLinkRepositoryContract::class;
    }


//    public static function show(...$args): \App\Models\Product
//    {
//        return Cache::remember(
//            "products:$args[0]",
//            now()->addMinutes(15),
//            fn() => self::__callStatic('show', $args)
//        );
//    }
//
//    public static function index(...$args): LengthAwarePaginator
//    {
//        return Cache::remember(
//            "products",
//            now()->addMinutes(15),
//            fn() => self::__callStatic('index', $args)
//        );
//    }

}