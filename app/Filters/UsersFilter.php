<?php

namespace App\Filters;

use \App\Filters\NameFilter;

class UsersFilter extends AbstractFilter
{
    protected $filters = [
        'name' => NameFilter::class,
        'email' => EmailFilter::class,
        'email_verified_at' => EmailVerifiedFilter::class,
        'created_at' => CreateAtFilter::class,
    ];

    protected $sortables = [
        'name' => NameSort::class,
        'email' => EmailSort::class,
        'email_verified_at' => EmailVerifiedSort::class,
        'created_at' => CreateAtSort::class,
    ];
}
