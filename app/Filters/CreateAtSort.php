<?php

namespace App\Filters;

class CreateAtSort
{
    public function filter($builder, $value)
    {
        if ($value)
            return $builder->orderBy('created_at', $value);
    }
}
