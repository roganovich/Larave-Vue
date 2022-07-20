<?php

namespace App\Services;

use App\Http\Resources\Point\PointResourceCollection;
use App\Models\Point;
use Lenius\Basket\Basket;
use Lenius\Basket\Item;

/**
 * Class Basket.
 */
class BasketService extends Basket
{
    private $_points;

    /**
     * @param mixed $points
     *
     * @return BasketService
     */
    public function setPoints(Point $points)
    {
        if (empty($this->_points)) {
            $this->_points = collect();
        }
        $this->_points->push($points);

        return $this;
    }

    /**
     * The total value of the basket.
     *
     * @param bool $includeTax Include tax on the total?
     *
     * @return float The total basket value
     */
    public function total($includeTax = true): float
    {
        $total = 0;

        /** @var Item $item */
        foreach ($this->contents() as $item) {
            // Считаем текущую стоимость продукта
            $total += round($item->product->price * $item->quantity, 2);
        }

        return (float) $total;
    }

    /**
     * Возвращаем точки хранения товаров в корзине
     *
     * @return mixed
     */
    public function points()
    {
        foreach ($this->contents() as $item) {
            $this->setPoints($item->point);
        }
        // Сортировка коллекции по городу
        $this->_points = $this->_points->sortBy([
            fn ($a, $b) => $a->city <=> $b->city
        ]);

        return $this->_points;
    }
}
