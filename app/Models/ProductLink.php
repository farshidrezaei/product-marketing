<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductLink extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'deleted_at' => 'datetime'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class)->withTrashed();
    }

    public function marketer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'marketer_id');
    }

    public function visits(): HasMany
    {
        return $this->hasMany(ProductLinkVisit::class, 'product_link_id');
    }

}
