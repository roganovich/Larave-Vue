<?php

namespace App\Filters;

class BoolFilter
{
    public function filter($builder, $value, $filter = null)
    {
        if (!is_null($value))
            return $builder->where($filter, $value);
    }
}
