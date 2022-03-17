<?php

namespace App\Filters\wikipages;

class ParentSort
{
    public function filter($builder, $value)
    {
        if ($value)
            return $builder->orderBy('parent_id', $value);
    }
}
