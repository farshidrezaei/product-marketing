<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'pictures' => 'array',
        'deleted_at' => 'datetime'
    ];

    public function links(): HasMany
    {
        return $this->hasMany(ProductLink::class);
    }

    public function getImagesAttribute(): array
    {
        return array_map(
            fn($picture) => config('filesystems.disks.minio.public_url')
                .'/'.config('filesystems.disks.minio.bucket')
                ."/$picture",
            $this->pictures ?? []
        );
    }
}
