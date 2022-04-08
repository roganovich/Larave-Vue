<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateLocale extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:CreateLocale';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Перенос локализации из php в json';


    protected $export = [];
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        echo 'Start' . PHP_EOL;
        // Путь к каталогу локализации
        $dir = base_path() . '/lang/';
        //echo $dir . PHP_EOL;
        // Находим каталоги всех языков
        $root = scandir($dir);
        foreach ($root as $folder) {
            $lang_path = $dir . $folder . '/';
            // Выбираем только каталоги
            if (is_dir($lang_path) && !in_array($folder, ['.', '..'])) {
                //echo $lang_path . PHP_EOL;
                // Находим все файлы локализации
                $lang = scandir($lang_path);
                // Создаем файл для JS в формате .json
                $json_name = $dir . $folder . '.json';
                $fp = fopen($json_name, 'w');
                $return = [];
                // Проходим по каждому файлу локализации
                foreach ($lang as $attribute_file) {
                    $attibute_path = $lang_path . $attribute_file;
                    //echo $attibute_path . PHP_EOL;
                    // Читаме данные только у файлов
                    if (is_file($attibute_path) && !in_array($attribute_file, ['.', '..'])) {
                        // Записываем данные файла в массив
                        $source = include($attibute_path);
                        $data = [];
                        // Перебираем все параметры массива
                        foreach ($source as $key => $value) {
                            $data = $this->get_data($key, $value, $data);
                        }
                        $file_info = pathinfo($attibute_path);
                        if ($data) {
                            $return[$file_info['filename']] = $data;
                        }

                    }
                }
                // Сохраняем файл
                fwrite($fp, json_encode($return, JSON_UNESCAPED_UNICODE));
                echo 'Save ' . $json_name . PHP_EOL;
                // Закрываем файл
                fclose($fp);
            }
        }
        echo 'End' . PHP_EOL;
    }

    /**
     * @param string $key
     * @param string $value
     * @return array $return
     */
    function get_data($key, $value, $data)
    {
        if (is_array($value)) {
            foreach ($value as $key2 => $value2) {
                $data[$key] = $this->get_data($key2, $value2, $data);
                return $data;
            }
        } else {
            //$value = 'The :attribute must have between :min and :max items.';
            // Находим по шаблону доп параметры строк
            $patterns = '/\:[a-zA-Z]*/';
            if (preg_match_all($patterns, $value, $rows)) {
                // Перебираем все доп параметры
                foreach ($rows[0] as $row) {
                    // Заменяем передаваемый параметар на формат json :title => {title}
                    $value = str_replace($row, '{' . str_replace(':', '', $row) . '}', $value);
                }
            }
            $data[$key] = $value;
        }

        return $data;
    }
}
