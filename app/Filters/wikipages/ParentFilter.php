<?php

namespace App\Filters\wikipages;

class ParentFilter
{
    public function filter($builder, $value)
    {
        if ($value)
            return $builder->where('parent_id', $value);
    }
}
