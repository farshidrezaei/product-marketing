<?php

namespace App\Http\Resources;

use App\Models\ProductLink;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin ProductLink */
class ProductLinkResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'url' => route('products.links.redirect', ['slug' => $this->slug]),
//            'product'=>ProductResource::make($this->product),
//            'marketer'=>UserResource::make($this->marketer),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
