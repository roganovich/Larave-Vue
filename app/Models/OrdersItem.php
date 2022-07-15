<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Point;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'title',
        'product_id',
        'point_id',
        'price',
        'qty',
        'amount',
        'param',
        'qty',
    ];

    protected $casts = [
        'param' => 'object',
    ];

    // Товар на момент оформления заказа
    public function getProductAttribute()
    {
        $id = $this->param->product->id;
        $product = Product::findOrFail($id);
        // В заказе цена должна быть на момент оформления заказа
        $product->price = $this->param->product->price;

        return $product;
    }

    // Склад на момент оформления заказа
    public function getPointAttribute()
    {
        return $this->param->point;
    }
}
