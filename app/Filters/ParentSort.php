<?php

namespace App\Filters;

class ParentSort
{
    public function filter($builder, $value)
    {
        if ($value)
            return $builder->orderBy('parent_id', $value);
    }
}
