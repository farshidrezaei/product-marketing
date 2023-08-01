<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Product */
class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'url' => $this->url,
            'description' => $this->description,
            'pictures' => $this->images ?? [],
            'created_at' => $this->created_at,
            'visits_count' => $this->whenHas('visits_count', $this->visits_count),
            'updated_at' => $this->updated_at,
        ];
    }
}
