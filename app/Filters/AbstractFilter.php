<?php

namespace App\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

abstract class AbstractFilter
{
    protected $request;

    protected $filters = [];

    public function __construct(array $request)
    {
        $this->request = $request;
    }

    /**
     * Фильтрация по полям
    */

    public function filter(Builder $builder)
    {
        foreach ($this->getFilters() as $filter => $value) {
            $this->resolveFilter($filter)->filter($builder, $value, $filter);
        }
        return $builder;
    }

    protected function getFilters()
    {
        return array_intersect_key($this->request, $this->filters);
    }

    protected function resolveFilter($filter)
    {
        return new $this->filters[$filter];
    }


    /**
     * Сортировка по полям
     */

    public function sortable(Builder $builder)
    {
        foreach ($this->getSortables() as $filter => $value) {
            $this->resolveSort($filter)->filter($builder, $value, $filter);
        }
        return $builder;
    }

    protected function getSortables()
    {
        return array_intersect_key($this->request, $this->sortables);
    }

    protected function resolveSort($filter)
    {
        return new $this->sortables[$filter];
    }
}
