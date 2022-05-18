<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Выполняем загрузку файла
     * @param Illuminate\Http\UploadedFile $file
     * @return string $filePath -путь хранения файла
     */
    public function upload($file)
    {
        $base_path = config('app.images');

        if (isset($this->file_folder)) {
            $file_folder = $this->file_folder;
        } else {
            // Получаем имя контроллера
            $routeArray = app('request')->route()->getAction();
            $controllerAction = class_basename($routeArray['controller']);
            list($controller, $action) = explode('@', $controllerAction);
            list($controllerName, $postrfix) = explode('Controller', $controller);
            $file_folder = $base_path . Str::snake($controllerName) . '/';
        }
        // Генерируем имя файла
        $name = md5(time() . $file->getClientOriginalName());
        // Указываем каталог для хранения
        $directory = $file_folder . date('Ymd') . '/';
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
