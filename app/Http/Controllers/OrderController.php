<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrdersItem;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;

class OrderController extends Controller
{

    /**
     * Список моих заказов
     */
    public function index()
    {
        $orders = Order::where(['user_id' => auth()->id()])->get();

        return view('orders.index', [
                'items' => $orders,
            ]
        );
    }

    /**
     * Просмотр текущего заказа
     */
    public function show(Order $order)
    {
        return view('orders.show', [
                'order' => $order,
            ]
        );
    }

    /**
     * Удаление текущего заказа
     */
    public function delete(Order $order)
    {
        $order->delete();

        return redirect()->route('order.index');
    }

    /**
     * Создание нового заказа
     *
     * @return void
     */
    public function create(Application $app)
    {
        // Оформить заказ может только авторизованный пользователь
        if (!auth()->id()) {
            return redirect()->route('login');
        }

        // Корзина
        $basket = $app->basket;
        // Точки выдачи товаров
        $points = $app->basket->points();

        /** Данные для построеник карточек магазинов*/
        $map_point = $points->map(function ($item, $key) {
            return [$item->map_longitude, $item->map_latitude];
        });

        return view('orders.create', [
                'basket' => $basket,
                'points' => $points,
                'map_point' => $map_point
            ]
        );
    }

    /**
     * Сохранение нового заказа
     *
     * @return void
     */
    public function store(Application $app, Request $request)
    {
        $validated = $request->validate([
            'point_id' => 'numeric|required',
            'comment' => '',
        ]);

        // Оформить заказ может только авторизованный пользователь
        if (!auth()->id()) {
            return redirect()->route('login');
        }

        // Все товары в корзине
        $items = $app->basket->contents();

        $dataOrder = [
            'amount' => $app->basket->total(),
            'user_id' => auth()->id(),
            'point_id' => $validated['point_id'],
            'comment' => $validated['comment'],
        ];

        // Создание заказа
        $order = Order::create($dataOrder);
        foreach ($items as $item) {
            $dataItem = [
                'order_id' => $order->id,
                'title' => $item->name,
                'product_id' => $item->product->id,
                'point_id' => $item->point->id,
                'price' => $item->price,
                'qty' => $item->quantity,
                'amount' => round($item->quantity * $item->price, 2),
                'param' => [
                    'point' => $item->point,
                    'product' => $item->product,
                ],
            ];

            // Массив картинок превращаем в json
            // Создание позиции заказа
            OrdersItem::create($dataItem);
        }
        // Все товары из корзины переносим в заказ, корзину очищаем
        $app->basket->destroy();

        return redirect()->route('order.index');
    }
}
