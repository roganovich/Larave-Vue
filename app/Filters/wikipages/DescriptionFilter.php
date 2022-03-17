<?php

namespace App\Filters\wikipages;

class DescriptionFilter
{
    public function filter($builder, $value)
    {
        if ($value)
            return $builder->where('description', 'LIKE', '%' . $value . '%');
    }
}
