<?php

namespace App\Models;

use App\Filters\PointsFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

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
        'type_id',
        'description',
        'area',
        'days',
        'map_longitude',
        'map_latitude',
        'map_zoom',

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
}
