<?php

namespace App\Filters;

class ParentSort
{
    /** TODO. сделать сортировку по title родителя*/
    public function filter($builder, $value, $filter = null)
    {
        if ($value)
            return $builder->orderBy('parent_id', $value);
    }
}
