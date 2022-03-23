<?php

namespace App\Filters;

class NameSort
{
    public function filter($builder, $value)
    {
        if ($value)
            return $builder->orderBy('name', $value);
    }
}
