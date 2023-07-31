<?php

namespace App\Http\Controllers\API\V1;

use App\Facades\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaginationRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{

    public function index(PaginationRequest $request)
    {
        $products = Product::index($request->validated('page'), $request->validated('per_page'));

        return response()->successResourceCollection(__('api.product.index'), ProductResource::collection($products));
    }

    public function show(int $productId)
    {
        return response()->success(__('api.product.show'), [
            'product' => ProductResource::make(Product::show($productId))
        ]);
    }

    public function store(ProductRequest $request): JsonResponse
    {
        $product = Product::store($request->validated());

        return response()->success(__('api.product.store'), ['product' => ProductResource::make($product)]);
    }

    public function update(ProductRequest $request, int $productId): JsonResponse
    {
        $product = Product::show($productId);
        $product = Product::update($product, $request->validated());

        return response()->success(__('api.product.update'), ['product' => ProductResource::make($product)]);
    }

    public function destroy(int $productId): JsonResponse
    {
        $product = Product::show($productId);
        Product::destroy($product);

        return response()->success(__('api.product.destroy'));
    }
}
