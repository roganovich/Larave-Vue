<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductsBrand;
use App\Models\ProductsCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    /**
     * List of products
     *
     * @return void
     */
    public function test_products_list()
    {
        $response = $this->get(route('products.index'));

        $response->assertStatus(200);
    }

    /**
     * Open product page
     *
     * @return void
     */
    public function test_products_show()
    {
        $item = Product::first();
        $response = $this->get(route('products.show', ['brand_slug'=>$item->brand->slug,'product_slug' => $item->slug]));

        $response->assertStatus(200);
    }

    /**
     * Filter products by brand
     *
     * @return void
     */
    public function test_products_filter_by_brand()
    {
        $item = ProductsBrand::first();
        $response = $this->get(route('products.index', ['Product[brand]' => $item->slug]));

        $response->assertStatus(200);
    }

    /**
     * Filter products by category
     *
     * @return void
     */
    public function test_products_filter_by_category()
    {
        $item = ProductsCategory::first();
        $response = $this->get(route('products.index', ['Product[category]' => $item->slug]));

        $response->assertStatus(200);
    }
}
