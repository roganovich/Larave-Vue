<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Filters\UsersFilter;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'created_at',
        'role_id',
    ];

    protected $appends = ['permissions_ids', 'permissions_allow_routes'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Поиск по полям
    public function scopeFilter(Builder $builder, $request)
    {
        return (new UsersFilter($request))->filter($builder);
    }

    // Сортировка по полям
    public function scopeSort(Builder $builder, $request)
    {
        return (new UsersFilter($request))->sortable($builder);
    }

    public function role()
    {
        return $this->belongsTo(UsersRole::class, 'role_id');
    }

    public function permissions()
    {
        return $this->hasMany(UsersRolesPermission::class, 'role_id', 'role_id');
    }

    public function getPermissionsIdsAttribute()
    {
        return $this->permissions->pluck('permission_id');
    }

    public function getPermissionsAllowRoutesAttribute()
    {
        return $this->permissions->pluck('permission.route_name');
    }
}
