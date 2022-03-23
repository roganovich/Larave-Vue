<?php

namespace App\Filters;

class NameFilter
{
    public function filter($builder, $value)
    {
        if ($value)
            return $builder->where('name', 'LIKE', '%' . $value . '%');
    }
}
