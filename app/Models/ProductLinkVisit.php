<?php

namespace App\Models;

use App\Http\Filters\AbstractFilter;
use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method Builder|self filter(AbstractFilter $filter)
 */
class ProductLinkVisit extends Model
{

    use Filterable;
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function link(): BelongsTo
    {
        return $this->belongsTo(ProductLink::class, 'product_link_id');
    }

}
