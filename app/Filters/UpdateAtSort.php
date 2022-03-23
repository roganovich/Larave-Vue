<?php

namespace App\Filters;

class UpdateAtSort
{
    public function filter($builder, $value)
    {
        if ($value)
            return $builder->orderBy('updated_at', $value);
    }
}
