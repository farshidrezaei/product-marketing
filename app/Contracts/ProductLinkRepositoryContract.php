<?php

namespace App\Contracts;

use App\Models\ProductLink;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductLinkRepositoryContract
{

    public function index(int|string $productId, ?int $page = 1, ?int $perPage = 15): LengthAwarePaginator;

    public function show(
        int|string $productId,
        int|string $productLinkId,
    ): ProductLink;

    public function findBySlug(string $slug): ProductLink;

    public function store(int|string $productId, string $slug): ProductLink;

    public function update(ProductLink $productLink, string $slug): ProductLink;

    public function destroy(ProductLink $productLink): bool;
}