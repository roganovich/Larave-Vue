<?php

namespace App\Http\Controllers;

use App\Http\Resources\Product\ProductResourceCollection;
use App\Models\Product;
use App\Models\ProductsBrand;
use App\Models\ProductsCategory;
use App\Models\ProductsType;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ProductsController extends Controller
{
    /**
     * Параметры поиска
     */
    private $search = [];

    /**
     * Параметры сортировки
     */
    private $sort = [
        'title' => 'ASC',
        'updated_at' => 'ASC'
    ];

    /** Фильтр по Бренду */
    protected $brand;
    /** Фильтр по Категории */
    protected $category;

    /**
     * @return ProductsCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param ProductsCategory $category
     */
    public function setType(ProductsCategory $category): void
    {
        $this->category = $category;
    }

    /**
     * @return ProductsBrand
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param ProductsBrand $brand
     */
    public function setBrand(ProductsBrand $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @param ProductsCategory $category
     */
    public function setCategory(ProductsCategory $category): void
    {
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $get = $request->get('Product');
        if ($brand = Arr::get($get,'brand')) {
            $brand = ProductsBrand::select(['id', 'slug'])->where(['slug' => $brand])->first();
            if (!$brand) {
                return 404;
            }
            $this->search['brand_id'] = $brand->id;
            $this->setBrand($brand);
        }

        if ($category = Arr::get($get,'category')) {
            $category = ProductsCategory::select(['id', 'slug'])->where(['slug' => $category])->first();
            if (!$category) {
                return 404;
            }
            $this->search['categories'] = $category->id;
            $this->setCategory($category);
        }

        $query = Product::filter($this->search)
            ->sort($this->sort)
            ->paginate(12);

        $items = new ProductResourceCollection($query);

        return view('products.index', [
                'items' => $items,
                'navFilter' => $this->getNav(),
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Product::findOrFail($id);

        $this->setBrand($item->brand);

        return view('products.show', [
            'item' => $item,
            'navFilter' => $this->getNav(),
        ]);
    }

    /**
     * Навигации по типам
     */
    public function getNav()
    {
        return (string)view('products.nav', [
            'brand' => $this->getBrand(),
            'brands' => $this->getAllBrands(),
            'caregories' => $this->getAllCategories(),
            'category' => $this->getCategory(),
            'total' => $this->getTotal()
        ]);
    }

    /**
     * Список типов
     * @return ProductResourceCollection
     */
    public function getAllBrands()
    {
        //return new ProductResourceCollection(Product::brands()->get());
        return ProductsBrand::select(['id', 'title', 'slug'])->get();
    }

    /**
     * Список категорий
     * @return ProductResourceCollection
     */
    public function getAllCategories()
    {
        return ProductsCategory::select(['id', 'title', 'slug'])->get();
    }



    /**
     * Количество записей в базе
     * @return int
     */
    public function getTotal()
    {
        return (int)Product::count();
    }

}
