<?php

namespace App\Filters;

class WikiPagesFilter extends AbstractFilter
{
    protected $filters = [
        'title' => TitleFilter::class,
        'description' => DescriptionFilter::class,
        'parent' => ParentFilter::class,
    ];

    protected $sortables = [
        'title' => TitleSort::class,
        'parent' => ParentSort::class,
        'updated_at' => UpdateAtSort::class,
    ];
}
