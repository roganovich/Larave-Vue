<?php

namespace App\Filters;

class LikeFilter
{
    public function filter($builder, $value, $filter = null)
    {
        if ($filter && $value)
            return $builder->where($filter, 'LIKE', '%' . $value . '%');
    }
}
