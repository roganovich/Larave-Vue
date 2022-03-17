<?php

namespace App\Filters\wikipages;

class TitleSort
{
    public function filter($builder, $value)
    {
        if ($value)
            return $builder->orderBy('title', $value);
    }
}
