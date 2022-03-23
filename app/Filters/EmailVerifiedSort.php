<?php

namespace App\Filters;

class EmailVerifiedSort
{
    public function filter($builder, $value)
    {
        if ($value)
            return $builder->orderBy('title', $value);
    }
}
