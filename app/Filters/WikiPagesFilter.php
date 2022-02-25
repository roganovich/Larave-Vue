<?php

// ProductFilter.php

namespace App\Filters;

use App\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class WikiPagesFilter extends AbstractFilter
{
    protected $filters = [
        'title' => TitleFilter::class,
        'description' => DescriptionFilter::class,
        'parent' => ParentFilter::class,
    ];
}
