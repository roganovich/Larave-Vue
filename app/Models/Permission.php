<?php

namespace App\Models;

use App\Filters\PermissionsFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'module',
        'title',
        'route_name',
        'route_path',
        'route_component'
    ];

    // Поиск по полям
    public function scopeFilter(Builder $builder, $request)
    {
        return (new PermissionsFilter($request))->filter($builder);
    }

    // Сортировка по полям
    public function scopeSort(Builder $builder, $request)
    {
        return (new PermissionsFilter($request))->sortable($builder);
    }
}
