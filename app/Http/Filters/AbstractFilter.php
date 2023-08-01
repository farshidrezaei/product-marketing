<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

abstract class AbstractFilter
{

    protected Builder $builder;

    public function __construct(private readonly Request $request)
    {
    }


    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;
        foreach ($this->request->input('filters') ?? [] as $name => $value) {
            $name = Str::of($name)->camel()->toString();
            if ($name !== 'apply' && method_exists($this, $name)) {
                call_user_func_array([$this, $name], array_filter([$value]));
            }
        }
        return $this->builder;
    }

}