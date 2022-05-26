<?php

namespace App\Filters;

class ProductsFilter extends AbstractFilter
{
    protected $filters = [
        'code' => LikeFilter::class,
        'brand_id' => EqualFilter::class,
        'title' => LikeFilter::class,
        'description' => LikeFilter::class,
        'categories' => LikeFilter::class,
        'attributes' => EqualFilter::class,
        'visible' => EqualFilter::class,
        'created_at' => EqualFilter::class,
        'updated_at' => EqualFilter::class,
    ];

    protected $sortables = [
        'code' => DefaultSort::class,
        'brand' => DefaultSort::class,
        'title' => DefaultSort::class,
        'visible' => DefaultSort::class,
        'created_at' => DefaultSort::class,
        'updated_at' => DefaultSort::class,
    ];
}
