<?php

namespace App\Filters;

class CreateAtFilter
{
    public function filter($builder, $value)
    {
        if ($value)
            return $builder->where('created_at', $value);
    }
}
