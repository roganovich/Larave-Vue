<?php

namespace App\Filters;

class ParentSort
{
    /** TODO. сделать сортировку по title родителя */
    public function filter($builder, $value, $filter = null)
    {
        if ($filter && $value)
            return $builder->orderBy($filter . '_id', $value);
    }
}
