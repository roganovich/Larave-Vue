<?php

namespace App\Filters;

class PointsFilter extends AbstractFilter
{
    protected $filters = [
        'country' => LikeFilter::class,
        'city' => LikeFilter::class,
        'title' => LikeFilter::class,
        'slug' => EqualFilter::class,
        'description' => LikeFilter::class,
        'type_id' => EqualFilter::class,
        'created_at' => EqualFilter::class,
        'updated_at' => EqualFilter::class,
    ];

    protected $sortables = [
        'country' => DefaultSort::class,
        'city' => DefaultSort::class,
        'title' => DefaultSort::class,
        'slug' => DefaultSort::class,
        'type_id' => DefaultSort::class,
        'type' => ParentSort::class,
        'created_at' => DefaultSort::class,
        'updated_at' => DefaultSort::class,
    ];
}
