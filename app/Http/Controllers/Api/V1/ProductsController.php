<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductResourceCollection;
use App\Http\Traits\UploadTrait;
use App\Models\Product;
use App\Models\ProductsBrand;
use App\Models\ProductsCategory;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    use UploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Product::filter($request->search)
            ->sort($request->sort)
            ->paginate(20);

        return new ProductResourceCollection($query);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categorieslist()
    {
        return ProductsCategory::select('id', 'title')->orderBy('title', 'ASC')->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function brandslist()
    {
        return ProductsBrand::select('id', 'title')->orderBy('title', 'ASC')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'code' => 'required|max:255',
            'brand_id' => 'numeric|nullable',
            'title' => 'required|max:255',
            'description' => 'required',
            'thumb' => '',
            'images' => '',
        ]);
        // Массив картинок превращаем в json
        $validate['images'] = ($validate['images'])?json_encode($validate['images']):'';

        $model = Product::create($validate);
        return $model;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        return Product::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'code' => 'required|max:255',
            'brand_id' => 'numeric|nullable',
            'title' => 'required|max:255',
            'description' => 'required',
            'thumb' => '',
            'images' => '',
        ]);

        $model = Product::findOrFail($id);
        $model->update($validate);

        return $model;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Product::findOrFail($id);
        $model->delete();
    }
}
