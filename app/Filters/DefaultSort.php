<?php

namespace App\Filters;

class DefaultSort
{
    public function filter($builder, $value, $filter = null)
    {
        if ($filter && $value)
            return $builder->orderBy($filter, $value);
    }
}
