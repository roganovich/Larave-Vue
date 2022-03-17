<?php

namespace App\Filters\wikipages;

class TitleFilter
{
    public function filter($builder, $value)
    {
        if ($value)
            return $builder->where('title', 'LIKE', '%' . $value . '%');
    }
}
