<?php

namespace App\Models;

use App\Filters\ProductsFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'brand_id',
        'title',
        'description',
        'thumb',
        'images',
        'categories',
        'attributes',
        'visible',
        'views',
        'created_at',
        'updated_at',
    ];

    // Поиск по полям
    public function scopeFilter(Builder $builder, $request)
    {
        return (new ProductsFilter($request))->filter($builder);
    }

    // Сортировка по полям
    public function scopeSort(Builder $builder, $request)
    {
        return (new ProductsFilter($request))->sortable($builder);
    }

    public function brand()
    {
        return $this->belongsTo(ProductsBrand::class, 'brand_id');
    }

    public function getImagesListAttribute()
    {
        return $this->images ? json_decode($this->images, true) : [];
    }

    public function getTextAttribute()
    {
        $data = [
            $this->brand->title,
            $this->code,
            $this->title,
        ];
        return implode(' ', $data);
    }

    // Группировка брендов
    public function scopeBrands($query)
    {
        return $query
            ->select('p.id', 'p.title', 'p.slug', DB::raw("count({$this->table}.id) as count"))
            ->join('product_brands as p', 'p.id', '=', "{$this->table}.brand_id")
            ->whereNull("{$this->table}.deleted_at")
            ->groupBy('p.id', 'p.title', 'p.slug')
            ->having(DB::raw("count({$this->table}.brand_id)"), '>', 0);
    }
}
