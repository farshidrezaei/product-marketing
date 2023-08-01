<?php

namespace App\Library;

use Illuminate\Support\Arr;

class CacheHelper
{
    public static function getHashedParameters(array $parameters): string
    {
        return md5(serialize(Arr::sort($parameters)));
    }
}