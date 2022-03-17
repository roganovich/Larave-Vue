<?php

namespace App\Filters\wikipages;

use App\Filters\AbstractFilter;

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
        'updated_at' => UpdateatSort::class,
    ];


}
