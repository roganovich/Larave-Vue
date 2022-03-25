<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use App\Filters\UsersRolesFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersRole extends Model
{
    use HasFactory;

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'is_root',
    ];

    protected $appends = ['permissions_ids'];

    // Поиск по полям
    public function scopeFilter(Builder $builder, $request)
    {
        return (new UsersRolesFilter($request))->filter($builder);
    }

    // Сортировка по полям
    public function scopeSort(Builder $builder, $request)
    {
        return (new UsersRolesFilter($request))->sortable($builder);
    }

    public function permissions()
    {
        return $this->hasMany(UsersRolesPermission::class, 'role_id');
    }

    public function getPermissionsIdsAttribute()
    {
        return $this->permissions->pluck('permission_id');
    }
}
