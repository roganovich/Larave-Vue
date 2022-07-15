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
        'param' => 'array',
    ];

    public function getProductAttribute()
    {
        $product = Product::findOrFail($this->product_id);
        // Определяем цену которая была в корзине
        $product->price = $this->param['product']['price'];

        return $product;
    }

    public function point()
    {
        return $this->belongsTo(Point::class, 'point_id');
    }
}
