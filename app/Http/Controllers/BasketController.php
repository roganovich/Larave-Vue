<?php

namespace App\Http\Controllers;

use App\Models\Point;
use App\Models\Product;
use App\Models\Rest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use \Illuminate\Contracts\Foundation\Application;

use Lenius\Basket\Basket;
use Lenius\Basket\Item;

class BasketController extends Controller
{
    /**
     * @var Basket
     */
    protected $_basket;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Application $app)
    {
        $this->_basket = $app->basket;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Корзина
        $basket = $this->_basket;

        return view('basket.index', ['basket' => $basket]);
    }

    /**
     * Clear basket
     *
     * @return \Illuminate\Http\Response
     */
    public function clear()
    {
        $this->_basket->destroy();
        return redirect()->route('basket.index');
    }

    /**
     * Add Item to basket
     *
     * @param Product $product
     * @param Point $point
     * @return \Illuminate\Http\Response
     */
    public function add(Product $product, Point $point)
    {
        $identifier = implode('_', [$product->id, $point->id]);

        // Прайсы могут меняться в течении дня. И нужно получать актуальную информацию
        $rest = Rest::where(['product_id' => $product->id, 'point_id' => $point->id])->first();

        if (!$rest) {
            throw (new ModelNotFoundException)->setModel(Rest::class, $identifier);
        }

        $item = array(
            'id' => $identifier,
            'name' => $product->fullTitle,
            'price' => $product->price,
            'quantity' => 1,
            'weight' => 0,
            'point' => $point,
            'product' => $product,
        );
        $newIdentifier = $this->_basket->insert(new Item($item));

        // Проверяем наличие товара на складе
        $newItem = $this->_basket->item($newIdentifier);
        if ($newItem->quantity > $rest->qty) {
            $newItem->update('quantity', $rest->qty);
        }


        return redirect()->route('basket.index');
    }

    /**
     * Increase the quantity of Item
     *
     * @param string $identifier
     * @return \Illuminate\Http\Response
     */
    public function plus($identifier)
    {
        $item = $this->_basket->item($identifier);

        if (!$item) {
            throw (new ModelNotFoundException)->setModel(Item::class, $identifier);
        }

        // Прайсы могут меняться в течении дня. И нужно получать актуальную информацию
        $rest = Rest::where(['product_id' => $item->product->id, 'point_id' => $item->point->id])->first();
        if (!$rest) {
            throw (new ModelNotFoundException)->setModel(Rest::class, $identifier);
        }

        // Проверяем наличие товара на складе
        $new_quantity = ($item->quantity < $rest->qty) ? $item->quantity + 1 : $item->quantity;
        $item->update('quantity', $new_quantity);

        return redirect()->route('basket.index');
    }

    /**
     * Decrease the quantity of Item
     *
     * @param string $identifier
     * @return \Illuminate\Http\Response
     */
    public function minus($identifier)
    {
        $item = $this->_basket->item($identifier);
        if (!$item) {
            throw (new ModelNotFoundException)->setModel(Item::class, $identifier);
        }
        $new_quantity = ($item->quantity > 1) ? $item->quantity - 1 : 1;
        $item->update('quantity', $new_quantity);

        return redirect()->route('basket.index');
    }

    /**
     * Delete Item
     *
     * @param string $identifier
     * @return \Illuminate\Http\Response
     */
    public function delete($identifier)
    {
        $item = $this->_basket->item($identifier);
        if (!$item) {
            throw (new ModelNotFoundException)->setModel(Item::class, $identifier);
        }
        $this->_basket->remove($identifier);

        return redirect()->route('basket.index');
    }
}
