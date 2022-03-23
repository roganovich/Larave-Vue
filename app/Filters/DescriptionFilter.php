<?php

namespace App\Filters;

class DescriptionFilter
{
    public function filter($builder, $value)
    {
        if ($value)
            return $builder->where('description', 'LIKE', '%' . $value . '%');
    }
}
