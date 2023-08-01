<?php

namespace App\Repositories;

use App\Contracts\ProductLinkRepositoryContract;
use App\Facades\Product;
use App\Models\ProductLink;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductLinkRepository implements ProductLinkRepositoryContract
{
    public function __construct(protected ProductLink $model)
    {
    }

    public function index(int|string $productId, ?int $page = 1, ?int $perPage = 15): LengthAwarePaginator
    {
        return $this->model
            ->query()
            ->whereMarketerId(Auth::id())
            ->whereProductId($productId)
            ->paginate(perPage: $perPage, page: $page);
    }


    public function show(int|string $productId, int|string $productLinkId): ProductLink
    {
        return $this->model
            ->query()
            ->whereMarketerId(Auth::id())
            ->whereProductId($productId)
            ->findOrFail($productLinkId);
    }

    /**
     * @throws Exception
     */
    public function store(int|string $productId, string $slug): ProductLink
    {
        $product = Product::show($productId);

        return $product->links()->create([
            'marketer_id' => Auth::id(),
            'slug' => $slug
        ]);
    }

    /**
     * @throws Exception
     */
    public function update(ProductLink $productLink, string $slug): ProductLink
    {
        $productLink->update(['slug' => $slug]);
        return $productLink;
    }

    public function destroy(ProductLink $productLink): bool
    {
        try {
            DB::beginTransaction();
            $productLink->delete();
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::critical('product link deletion failed.', [
                'message' => $exception->getMessage(),
                'exception' => get_class($exception),
                'product_link_id' => $productLink->id,
            ]);
            throw $exception;
        }

        return true;
    }


    public function findBySlug(string $slug): ProductLink
    {
        return $this->model
            ->query()
            ->with('product')
            ->whereSlug($slug)
            ->firstOrFail();
    }
}