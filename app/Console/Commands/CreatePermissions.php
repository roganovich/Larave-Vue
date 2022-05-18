<?php

namespace App\Console\Commands;

use App\Models\Wikipage;
use Illuminate\Console\Command;
use App\Models\Permission;

class CreatePermissions extends Command
{
    const MODULE_ADMIN = 'admin';
    const MODULE_CABINET = 'cabinet';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:CreatePermissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Обновление всех номых маршрутов для раздачи прав доступа';

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
        // Путь к файлу маршрутизации
        $route_path = base_path() . '/resources/js/routes.js';
        echo $route_path . PHP_EOL;

        // Считываем файл JS
        $rout_file = file_get_contents($route_path);
        $split = explode('export const routes =', $rout_file);
        $route_json = (string)$split[1];

        // Находим блоки маршрутов
        preg_match_all('|{(.*)}|sU', $route_json, $rows);

        $permissions = [];
        $i = 0;
        foreach ($rows[0] as $row) {
            $i++;
            $row = preg_replace('/[^0-9A-z\/-_:,]/', '', $row);
            $attributes = explode(',', $row);
            // Находим свойстав маршрутов
            foreach ($attributes as $item) {
                if ($item) {
                    $data = explode(':', $item);
                    $name = $data[0];
                    $value = $data[1];
                    $permissions[$i][$name] = $value;
                }
            }

        }

        $this->add_permission($permissions);
    }

    private function prepare_to_add($item)
    {
        return [
            'module' => self::MODULE_ADMIN,
            'route_name' => $item['name'],
            'route_path' => $item['path'],
            'route_component' => $item['component']
        ];
    }

    private function add_permission($permissions)
    {
        foreach ($permissions as $item) {
            $model = Permission::where([
                'module' => self::MODULE_ADMIN,
                'route_name' => $item['name']])->first();
            if ($model) {
                $model->update($this->prepare_to_add($item));
                $model->save();
            } else {
                $data = $this->prepare_to_add($item);
                $model = new Permission();
                $model->module = $data['module'];
                $model->title = $data['route_name'];
                $model->route_name = $data['route_name'];
                $model->route_path = $data['route_path'];
                $model->route_component = $data['route_component'];
                $model->save();
            }
        }
    }
}
