<?php

namespace App\Services;

use App\Models\Product;
use Lenius\Basket\Basket;
use Lenius\Basket\Item;

/**
 * Class Basket.
 */
class BasketService extends Basket
{
    /**
     * The total number of items in the basket.
     *
     * @param bool $unique Just return unique items?
     *
     * @return int Total number of items
     */
    public function totalItems($unique = false): int
    {
        $total = 0;

        /** @var Item $item */
        foreach ($this->contents() as $item) {
            // Считаем текущую стоимость продукта
            $total += round($item->product->price * $item->quantity, 2);
        }

        return $total;
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
            $total += $item->product->price;
        }

        return (float) $total;
    }
}
