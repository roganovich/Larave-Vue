<?php

namespace App\Filters;

class UsersFilter extends AbstractFilter
{
    protected $filters = [
        'name' => LikeFilter::class,
        'email' => LikeFilter::class,
        'email_verified_at' => EmailVerifiedFilter::class,
        'created_at' => EqualFilter::class,
        'role_id' => EqualFilter::class,
    ];

    protected $sortables = [
        'name' => DefaultSort::class,
        'email' => DefaultSort::class,
        'email_verified_at' => DefaultSort::class,
        'created_at' => DefaultSort::class,
        'role' => ParentSort::class,
    ];
}
