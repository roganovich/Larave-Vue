<?php

namespace App\Filters;

class EmailFilter
{
    public function filter($builder, $value)
    {
        if ($value)
            return $builder->where('email', 'LIKE', '%' . $value . '%');
    }
}
