<?php

namespace App\Models;

use App\Filters\OrdersFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    const STATUS_NEW = 1;
    const STATUS_CONFIRM = 2;

    public static function getStatuses()
    {
        return collect([
            [
                'id' => self::STATUS_NEW,
                'title' => __('orders.statuses.new'),
            ],
            [
                'id' => self::STATUS_CONFIRM,
                'title' => __('orders.statuses.confirm'),
            ],
        ]);
    }

    protected $fillable = [
        'amount',
        'user_id',
        'point_id',
        'comment',
        'manager_id',
        'status'
    ];

    // Поиск по полям
    public function scopeFilter(Builder $builder, $request)
    {
        return (new OrdersFilter($request))->filter($builder);
    }

    // Сортировка по полям
    public function scopeSort(Builder $builder, $request)
    {
        return (new OrdersFilter($request))->sortable($builder);
    }

    public function items()
    {
        return $this->hasMany(OrdersItem::class, 'order_id', 'id');
    }

    public function point()
    {
        return $this->belongsTo(Point::class, 'point_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    /**
     * Точки нахождения товаров заказа
     */
    public function getMapPointAttribute()
    {
        return $this->items->map(function ($item, $key) {
            return [$item->point->map_longitude, $item->point->map_latitude];
        });
    }

    /**
     * Имя статуса заказа
     */
    public function getStatusNameAttribute()
    {
        return self::getStatuses()->where('id', $this->status)->pluck('title')->first();
    }
}
