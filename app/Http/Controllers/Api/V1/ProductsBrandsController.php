<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductBrandResourceCollection;
use App\Http\Traits\UploadTrait;
use App\Models\ProductsBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductsBrandsController extends Controller
{
    use UploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = ProductsBrand::filter($request->search)
            ->sort($request->sort)
            ->paginate(20);

        return new ProductBrandResourceCollection($query);
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
            'title' => 'required|max:255',
            'slug' => 'nullable',
            'description' => 'required',
            'thumb' => '',
        ]);

        if(empty($validate['slug'])){
            $validate['slug'] = Str::slug($validate['title'], '_');
        }else{
            $validate['slug'] = Str::slug($validate['slug'], '_');
        }

        $model = ProductsBrand::create($validate);
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
        return ProductsBrand::findOrFail($id);
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
            'title' => 'required|max:255',
            'slug' => 'nullable',
            'description' => 'required',
            'thumb' => '',
        ]);

        if(empty($validate['slug'])){
            $validate['slug'] = Str::slug($validate['title'], '_');
        }else{
            $validate['slug'] = Str::slug($validate['slug'], '_');
        }

        $model = ProductsBrand::findOrFail($id);
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
        $model = ProductsBrand::findOrFail($id);
        $model->delete();
    }
}
