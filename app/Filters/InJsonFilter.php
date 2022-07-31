<?php

namespace App\Filters;

class InJsonFilter
{
    public function filter($builder, $value, $filter = null)
    {
        if ($filter && $value) {
            return $builder->whereJsonContains($filter, $value);
        }
    }
}
