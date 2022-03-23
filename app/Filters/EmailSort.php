<?php

namespace App\Filters;

class EmailSort
{
    public function filter($builder, $value)
    {
        if ($value)
            return $builder->orderBy('email', $value);
    }
}
