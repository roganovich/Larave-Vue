<?php

namespace App\Models;

use App\Filters\PointsFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Point extends Model
{
    use HasFactory;

    protected $table = 'points';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'country',
        'city',
        'address',
        'title',
        'slug',
        'type_id',
        'description',
        'area',
        'days',
        'map_longitude',
        'map_latitude',
        'map_zoom',
        'thumb',
        'images',
    ];

    // Поиск по полям
    public function scopeFilter(Builder $builder, $request)
    {
        return (new PointsFilter($request))->filter($builder);
    }

    // Сортировка по полям
    public function scopeSort(Builder $builder, $request)
    {
        return (new PointsFilter($request))->sortable($builder);
    }

    public function type()
    {
        return $this->belongsTo(PointsType::class, 'type_id');
    }

    public function getImagesListAttribute()
    {
        return $this->images ? json_decode($this->images, true) : [];
    }

    public function getPointThumbAttribute()
    {
        return (!empty($this->thumb)) ? $this->thumb : config('app.noimage');
    }

    // Группировка типов
    public function scopeTypes($query)
    {
        return $query
            ->select('p.id', 'p.title', DB::raw("count({$this->table}.id) as count"))
            ->join('points_types as p', 'p.id', '=', "{$this->table}.type_id")
            ->whereNull("{$this->table}.deleted_at")
            ->groupBy('p.id', 'p.title')
            ->having(DB::raw("count({$this->table}.type_id)"), '>', 0);
    }

    // Группировка городов
    public function scopeCities($query)
    {
        return $query
            ->select('id', 'city as title', DB::raw("count(id) as count"))
            ->whereNull("{$this->table}.deleted_at")
            ->groupBy('id', 'city')
            ->having(DB::raw("count(city)"), '>', 0);
    }
}
