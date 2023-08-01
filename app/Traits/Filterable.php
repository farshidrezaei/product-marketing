<?php


namespace App\Traits;


use App\Http\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

trait Filterable
{

    /**
     * @param Builder $builder
     * @param Filter $filter
     * @return Builder
     */
    public function scopeFilter(Builder $builder, AbstractFilter $filter): Builder
    {
        return $filter->apply($builder);
    }
}
