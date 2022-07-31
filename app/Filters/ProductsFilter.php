<?php

namespace App\Filters;

class ProductsFilter extends AbstractFilter
{
    protected $filters = [
        'id' => EqualFilter::class,
        'code' => LikeFilter::class,
        'brand_id' => EqualFilter::class,
        'title' => LikeFilter::class,
        'slug' => LikeFilter::class,
        'categories' => InJsonFilter::class,
        'visible' => EqualFilter::class,
        'created_at' => EqualFilter::class,
        'updated_at' => EqualFilter::class,
    ];

    protected $sortables = [
        'id' => DefaultSort::class,
        'code' => DefaultSort::class,
        'brand_id' => DefaultSort::class,
        'title' => DefaultSort::class,
        'slug' => DefaultSort::class,
        'visible' => DefaultSort::class,
        'created_at' => DefaultSort::class,
        'updated_at' => DefaultSort::class,
    ];
}
