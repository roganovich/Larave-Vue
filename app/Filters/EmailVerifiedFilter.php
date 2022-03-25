<?php

namespace App\Filters;

class EmailVerifiedFilter
{
    public function filter($builder, $value, $filter = null)
    {
        if ($value == 'yes') {
            return $builder->whereNotNull('email_verified_at');
        } else if ($value == 'no') {
            return $builder->whereNull('email_verified_at');
        }
    }
}
