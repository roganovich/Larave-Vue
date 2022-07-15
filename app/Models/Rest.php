<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rest extends Model
{
    use HasFactory;

    public function point()
    {
        return $this->belongsTo(Point::class, 'point_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
