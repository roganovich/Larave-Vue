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
    //use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;

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
        'price',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'categories' => 'json',
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

    public function getCategoriesListAttribute()
    {
        return collect(json_decode($this->categories))->map(function ($id) {
            return ProductsCategory::find($id);
        });
    }

    public function restList()
    {
        return $this->hasMany(Rest::class, 'product_id');
    }

    public function getProductThumbAttribute()
    {
        return (!empty($this->thumb)) ? $this->thumb : '/uploads/images/noimage.png';
    }

    public function getImagesListAttribute()
    {
        return $this->images ? json_decode($this->images, true) : [];
    }

    public function getFullTitleAttribute()
    {
        $data = [
            $this->brand->title,
            $this->code,
            $this->title,
        ];

        return implode(' ', $data);
    }

    /**
     * Группировка брендов
     * Получить все товары по брендам
     */
    /*public function scopeBrands($query)
    {
        return $query
            ->select('p.id', 'p.title', 'p.slug', DB::raw("count({$this->table}.id) as count"))
            ->join('product_brands as p', 'p.id', '=', "{$this->table}.brand_id")
            ->whereNull("{$this->table}.deleted_at")
            ->groupBy('p.id', 'p.title', 'p.slug')
            ->having(DB::raw("count({$this->table}.brand_id)"), '>', 0);
    }*/

    /**
     * Группировка категорий
     * Получить все товары по категорииям
     */
    /*public function scopeCategories($query)
   {
       return $query
           ->select('p.id', 'p.title', 'p.slug', DB::raw("count({$this->table}.id) as count"))
           ->join('product_caregories as p', 'p.id', '=', "{$this->table}.brand_id")
           ->whereNull("{$this->table}.deleted_at")
           ->groupBy('p.id', 'p.title', 'p.slug')
           ->having(DB::raw("count({$this->table}.brand_id)"), '>', 0);
   }*/
}
