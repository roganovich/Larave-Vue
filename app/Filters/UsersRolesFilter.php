<?php

namespace App\Filters;

class UsersRolesFilter extends AbstractFilter
{
    protected $filters = [
        'title' => EqualFilter::class,
        'is_root' => BoolFilter::class,
    ];

    protected $sortables = [
        'title' => DefaultSort::class,
        'is_root' => DefaultSort::class,
    ];
}
