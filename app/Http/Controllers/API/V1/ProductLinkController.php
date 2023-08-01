<?php

namespace App\Http\Controllers\API\V1;

use App\Facades\ProductLink;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaginationRequest;
use App\Http\Requests\ProductLinkRequest;
use App\Http\Resources\ProductLinkResource;
use Illuminate\Http\JsonResponse;

class ProductLinkController extends Controller
{
    public function index(PaginationRequest $request, int|string $productId)
    {
        $products = ProductLink::index($productId, $request->validated('page'), $request->validated('per_page'));

        return response()->successResourceCollection(__('api.productLink.index'), ProductLinkResource::collection($products));
    }

    public function show(int $productId, int $productLinkId)
    {
        return response()->success(__('api.productLink.show'), [
            'product_link' => ProductLinkResource::make(ProductLink::show($productId, $productLinkId))
        ]);
    }


    public function store(ProductLinkRequest $request, int|string $productId): JsonResponse
    {
        $productLink = ProductLink::store($productId, $request->validated('slug'));

        return response()->success(__('api.productLink.store'), ['product' => ProductLinkResource::make($productLink)]);
    }


    public function update(ProductLinkRequest $request, int $productId, int $productLinkId): JsonResponse
    {
        $productLink = ProductLink::update(ProductLink::show($productId, $productLinkId), $request->validated('slug'));

        return response()->success(__('api.productLink.update'), ['product' => ProductLinkResource::make($productLink)]);
    }

    public function destroy(int $productId, int $productLinkId): JsonResponse
    {
        ProductLink::destroy(ProductLink::show($productId, $productLinkId));

        return response()->success(__('api.productLink.destroy'));
    }
}
