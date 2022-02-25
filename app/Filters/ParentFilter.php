<?php

namespace App\Filters;

class ParentFilter
{
    public function filter($builder, $value)
    {
        if ($value)
            return $builder->where('parent_id', $value);
    }
}
