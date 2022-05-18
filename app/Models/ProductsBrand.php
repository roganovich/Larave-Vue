<?php

namespace App\Models;

use App\Filters\ProductsBrandsFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductsBrand extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'product_brands';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'thumb',
        'created_at',
        'updated_at',
    ];

    // Поиск по полям
    public function scopeFilter(Builder $builder, $request)
    {
        return (new ProductsBrandsFilter($request))->filter($builder);
    }

    // Сортировка по полям
    public function scopeSort(Builder $builder, $request)
    {
        return (new ProductsBrandsFilter($request))->sortable($builder);
    }
}
