<?php

namespace App\Http\Controllers;

use App\Http\Resources\Point\PointResourceCollection;
use App\Models\Point;
use App\Models\PointsType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PointsController extends Controller
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

    /** Фильтр по типам */
    protected $type;
    /** Фильтр по городам */
    protected $city;

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param PointsType $type
     */
    public function setType(PointsType $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($type = $request->get('type')) {
            $type = PointsType::where(['title' => $type])->first();
            if (!$type) {
                return 404;
            }
            $this->search['type_id'] = $type->id;
            $this->setType($type);
        }
        if ($city = $request->get('city')) {
            $this->search['city'] = $city;
            $this->setCity($city);
        }
        $query = Point::filter($this->search)
            ->sort($this->sort)
            ->paginate(12);

        $items = new PointResourceCollection($query);

        /** Данные для построеник карточек магазинов*/
        $map_point = $items->map(function ($item, $key) {
            return [$item->map_longitude, $item->map_latitude];
        });

        return view('points.index', [
                'items' => $items,
                'map_point' => $map_point,
                'navFilter' => $this->getNav(),
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $item = Point::where(['slug' => $slug])->first();
        if (!$item) {
            throw (new ModelNotFoundException)->setModel(Point::class, $slug);
        }
        $this->setType($item->type);
        $this->setCity($item->city);

        $items = new Collection();
        $items->add($item);
        /** Данные для построеник карточек магазинов*/
        $map_point = $items->map(function ($item, $key) {
            return [$item->map_longitude, $item->map_latitude];
        });

        return view('points.show', [
            'item' => $item,
            'map_point' => $map_point,
            'navFilter' => $this->getNav(),
        ]);
    }

    /**
     * Навигации по типам
     */
    public function getNav()
    {
        return (string)view('points.nav', [
            'type' => $this->getType(),
            'city' => $this->getCity(),
            'types' => $this->getAllTypes(),
            'cities' => $this->getAllCities(),
            'total' => $this->getTotal()
        ]);
    }

    /**
     * Количество записей в базе
     * @return int
     */
    public function getTotal()
    {
        return (int)Point::count();
    }

    /**
     * Список типов
     * @return PointResourceCollection
     */
    public function getAllTypes()
    {
        return new PointResourceCollection(Point::types()->get());
    }

    /**
     * Список городов
     * @return PointResourceCollection
     */
    public function getAllCities()
    {
        return new PointResourceCollection(Point::cities()->get());
    }
}
