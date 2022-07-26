<?php

namespace Tests\Feature;

use App\Models\Rest;
use Illuminate\Support\Facades\Log;
use PHPUnit\TextUI\XmlConfiguration\PHPUnit;
use Tests\TestCase;

class BasketTest extends TestCase
{
    /**
     * Add to basket
     *
     * @return void
     */
    public function test_basket_add()
    {
        $price = Rest::first();
        $this->get(route('basket.add', ['product'=>$price->product, 'point' => $price->point]));

        $basket = app()->basket;
        $sum1 =  $basket->total();

        Log::info(sprintf('Total Summ: %s', $sum1));

        $item = reset($basket->contents());

        $this->get(route('basket.plus', ['identifier'=>$item->identifier]));

        $basket = app()->basket;
        $sum2 = $basket->total();

        Log::info(sprintf('Total Summ: %s', $sum2));

        $this->get(route('basket.minus', ['identifier'=>$item->identifier]));

        $basket = app()->basket;
        $sum3 = $basket->total();

        Log::info(sprintf('Total Summ: %s', $sum3));


        if ($sum1 != $sum3){
            Log::info('Dont work basket minus');
        }

        if ($sum2 != $sum1*2){
            Log::info('Dont work basket plus');
        }

        Log::info('Basket is work');
    }
}
