<?php

namespace App\Filters;

class TitleSort
{
    public function filter($builder, $value)
    {
        if ($value)
            return $builder->orderBy('title', $value);
    }
}
