<?php

namespace App\Filters\wikipages;

class UpdateatSort
{
    public function filter($builder, $value)
    {
        if ($value)
            return $builder->orderBy('updated_at', $value);
    }
}
