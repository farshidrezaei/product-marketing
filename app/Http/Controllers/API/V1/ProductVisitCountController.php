<?php

namespace App\Http\Controllers\API\V1;

use App\Facades\Product;
use App\Http\Controllers\Controller;
use App\Http\Filters\ProductVisitFilter;
use App\Http\Requests\PaginatedProductVisitCountRequest;
use App\Http\Requests\ProductVisitCountRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductVisitCountController extends Controller
{

    public function index(PaginatedProductVisitCountRequest $request, ProductVisitFilter $filter): AnonymousResourceCollection
    {
        return response()->successResourceCollection(
            'product visits count',
            ProductResource::collection(
                Product::indexWithVisitsCount($request, $filter, $request->input('page'), $request->input('per_page'))
            )
        );
    }

    public function show(ProductVisitCountRequest $request, ProductVisitFilter $filter, int|string $productId): JsonResponse
    {
        return response()->success(
            'product visits count',
            ['count' => Product::countVisitsCached($productId, $filter, $request)]
        );
    }
}
