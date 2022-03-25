<?php

namespace App\Filters;

class EqualFilter
{
    public function filter($builder, $value, $filter = null)
    {
        if ($filter && $value)
            return $builder->where($filter, $value);
    }
}
