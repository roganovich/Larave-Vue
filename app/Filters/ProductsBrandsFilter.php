<?php

namespace App\Filters;

class ProductsBrandsFilter extends AbstractFilter
{
    protected $filters = [
        'title' => LikeFilter::class,
        'slug' => EqualFilter::class,
    ];

    protected $sortables = [
        'title' => DefaultSort::class,
        'slug' => DefaultSort::class,
    ];
}
