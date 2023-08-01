<?php


namespace App\Http\Filters;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class ProductVisitFilter extends AbstractFilter
{


    public function marketerId(?string $marketerId = null): Builder
    {
        return $this->builder->when(
            $marketerId,
            fn($query, $marketerId) => $query->whereHas(
                'link',
                fn(Builder $builder) => $builder->where('marketer_id', $marketerId)
            )
        );
    }


    public function range(?array $range = null): Builder
    {
        return $this->builder->when(
            $range,
            fn($query, $range) => $query->when(
                $range['from'],
                fn(Builder $builder, $from) => $builder->where(
                    'created_at',
                    '>=',
                    Carbon::createFromFormat('Y/m/d H:i:s', $from)
                )
            )
                ->when(
                    $range['to'],
                    fn(Builder $builder, $to) => $builder->where(
                        'created_at',
                        '<=',
                        Carbon::createFromFormat('Y/m/d H:i:s', $to)
                    )
                )

        );
    }


}
