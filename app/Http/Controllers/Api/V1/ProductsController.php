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

    private $file_folder = '/uploads/images/products/';

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

    /**
     * Выполняем загрузку файла
     * @param Illuminate\Http\UploadedFile $file
     * @return string $filePath -путь хранения файла
     */
    public function upload($file)
    {
        // Генерируем имя файла
        $name = md5(time() . $file->getClientOriginalName());
        // Указываем каталог для хранения
        $directory = $this->file_folder . date('Ymd') . '/';
        // Полное имя файла с каталогом
        $filePath = $directory . $name . '.' . $file->getClientOriginalExtension();
        // Загружаем файл
        $this->uploadOne($file, $directory, 'public', $name);

        return $filePath;
    }

    /**
     * Загрузка файла
    */
    public function add_images(Request $request)
    {
        $urls = [];
        // Валидация формы
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        // Перебираем все полученные файлы
        if ($request->hasFile('images')) {
            foreach ($request->images as $file) {
                // Заполняем массив с загруженными файлами
                $urls[] = $this->upload($file);
            }
        }
        // Позвращаем список сохраненных файлов
        return json_encode(['urls' => $urls]);
    }
}
