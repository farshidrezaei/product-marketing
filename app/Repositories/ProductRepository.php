<?php

namespace App\Repositories;

use App\Contracts\ProductRepositoryContract;
use App\Http\Filters\ProductVisitFilter;
use App\Http\Requests\PaginatedProductVisitCountRequest;
use App\Models\Product;
use App\Models\ProductLinkVisit;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductRepository  implements ProductRepositoryContract
{
    public function __construct(protected Product $model)
    {
    }

    public function index(?int $page = 1, ?int $perPage = 15): LengthAwarePaginator
    {
        return $this->model
            ->query()
            ->paginate(perPage: $perPage, page: $page);
    }


    public function show(int $productId): Product
    {
        return $this->model
            ->query()
            ->findOrFail($productId);

    }

    /**
     * @throws Exception
     */
    public function store(array $attributes): Product
    {
        try {
            DB::beginTransaction();

            $product = Auth::user()->products()->create(Arr::except($attributes, 'pictures'));

            $pictures = $this->uploadPictures($product, $attributes['pictures'] ?? []);

            $product->update(['pictures' => $pictures]);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::critical('product store failed.', [
                'message' => $exception->getMessage(),
                'exception' => get_class($exception),
            ]);
            throw $exception;
        }

        return $product;
    }

    /**
     * @throws Exception
     */
    public function update(Product $product, array $attributes): Product
    {
        try {
            DB::beginTransaction();

            $pictures = $this->uploadPictures($product, $attributes['pictures'] ?? []);

            $product->update([...Arr::except($attributes, 'pictures'), 'pictures' => $pictures]);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::critical('product update failed.', [
                'message' => $exception->getMessage(),
                'exception' => get_class($exception),
                'product_id' => $product->id,
            ]);
            throw $exception;
        }

        return $product;
    }

    public function destroy(Product $product): bool
    {
        try {
            DB::beginTransaction();
            $product->delete();
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::critical('product deletion failed.', [
                'message' => $exception->getMessage(),
                'exception' => get_class($exception),
                'product_id' => $product->id,
            ]);
            throw $exception;
        }

        return true;
    }


    private function uploadPictures(Product $product, array $pictures): array
    {
        $path = "/products/".Auth::id()."/".$product->id;
        return array_map(fn(UploadedFile $picture) => $this->uploadImage($picture, $path), $pictures);
    }

    private function uploadImage(UploadedFile $file, string $path): string
    {
        $name = "picture-".uniqid().".".$file->getClientOriginalExtension();

        Storage::disk('minio')->putFileAs($path, $file, $name);

        return "$path/$name";
    }

    public function countVisits(int|string $productId, ProductVisitFilter $filter): int
    {
        return ProductLinkVisit::filter($filter)
            ->whereRelation('link.product', 'id', '=', $productId)
            ->count();
    }


    public function indexWithVisitsCount(
        PaginatedProductVisitCountRequest $request,
        ProductVisitFilter $filter,
        ?int $page = 1,
        ?int $perPage = 15
    ): LengthAwarePaginator {
        $data = $this->model
            ->query()
            ->paginate(perPage: $perPage, page: $page);
        $data->through(function (Product $item) use ($request, $filter) {
            $item->visits_count = \App\Facades\Product::countVisitsCached($item->id, $filter, $request);
            return $item;
        });
        return $data;
    }
}