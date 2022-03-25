<?php

namespace App\Filters;

class PermissionsFilter extends AbstractFilter
{
    protected $filters = [
        'module' => EqualFilter::class,
        'title' => LikeFilter::class,
        'route_name' => LikeFilter::class,
        'route_path' => LikeFilter::class,
        'route_component' => LikeFilter::class,
    ];

    protected $sortables = [
        'module' => DefaultSort::class,
        'title' => DefaultSort::class,
        'route_name' => DefaultSort::class,
        'route_path' => DefaultSort::class,
        'route_component' => DefaultSort::class,
    ];
}
