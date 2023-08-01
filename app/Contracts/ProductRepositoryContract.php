<?php

namespace App\Contracts;

use App\Http\Filters\ProductVisitFilter;
use App\Http\Requests\PaginatedProductVisitCountRequest;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductRepositoryContract
{

    public function index(?int $page = 1, ?int $perPage = 15): LengthAwarePaginator;

    public function indexWithVisitsCount(
        PaginatedProductVisitCountRequest $request,
        ProductVisitFilter $filter,
        ?int $page = 1,
        ?int $perPage = 1
    ): LengthAwarePaginator;

    public function show(int $productId): Product;

    public function countVisits(int|string $productId, ProductVisitFilter $filter): int;

    public function store(array $attributes): Product;

    public function update(Product $product, array $attributes): Product;

    public function destroy(Product $product): bool;
}