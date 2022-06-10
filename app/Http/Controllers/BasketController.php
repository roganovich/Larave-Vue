<?php

namespace App\Http\Controllers;

use App\Models\Point;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use Lenius\Basket\Basket;
use Lenius\Basket\Storage\Session;
use Lenius\Basket\Identifier\Cookie;
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
    public function __construct()
    {
        $this->_basket = new Basket(new Session, new Cookie);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = $this->_basket->contents();

        return view('basket.index', [
                'items' => $items,
            ]
        );
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
        //Format array of required info for item to be added to basket...
        $item = array(
            'id' => $product->id,
            'name' => $product->fullTitle,
            'price' => $product->price,
            'quantity' => 1,
            'weight' => 0,
            'point' => $point,
            'product' => $product,
        );
        $this->_basket->insert(new Item($item));

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
        $new_quantity = $item->quantity + 1;
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
