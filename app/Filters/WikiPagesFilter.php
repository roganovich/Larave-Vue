<?php

namespace App\Filters;

class WikiPagesFilter extends AbstractFilter
{
    protected $filters = [
        'title' => LikeFilter::class,
        'description' => LikeFilter::class,
        'parent' => EqualFilter::class,
    ];

    protected $sortables = [
        'title' => DefaultSort::class,
        'parent' => ParentSort::class,
        'updated_at' => DefaultSort::class,
    ];
}
