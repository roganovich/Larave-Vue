<?php

namespace App\Filters;

class OrdersFilter extends AbstractFilter
{
    protected $filters = [
        'id' => EqualFilter::class,
        'amount' => LikeFilter::class,
        'user_id' => LikeFilter::class,
        'point_id' => LikeFilter::class,
        'comment' => EqualFilter::class,
        'manager_id' => LikeFilter::class,
        'status' => EqualFilter::class,
    ];

    protected $sortables = [
        'id' => DefaultSort::class,
        'amount' => DefaultSort::class,
        'user_id' => DefaultSort::class,
        'point_id' => DefaultSort::class,
        'comment' => DefaultSort::class,
        'manager_id' => ParentSort::class,
        'status' => DefaultSort::class,
        'created_at' => DefaultSort::class,
        'updated_at' => DefaultSort::class,
    ];
}
