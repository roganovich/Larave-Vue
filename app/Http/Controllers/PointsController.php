<?php

namespace App\Http\Controllers;

use App\Http\Resources\Point\PointResourceCollection;
use App\Models\Point;
use App\Models\PointsType;
use Illuminate\Http\Request;

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

    protected $type;

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($type_id = $request->get('type_id')) {
            $this->search['type_id'] = $type_id;
            $type = PointsType::findOrFail($type_id);
            $this->setType($type);
        }
        $query = Point::filter($this->search)
            ->sort($this->sort)
            ->paginate(12);

        $items = new PointResourceCollection($query);

        return view('points.index', ['items' => $items, 'typesNav' => $this->getTypesNav()]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Point::findOrFail($id);
        $this->setType($item->type);
        return view('points.show', ['item' => $item, 'typesNav' => $this->getTypesNav()]);
    }

    public function getTypesNav(){
        $items = PointsType::orderBy('title');
        return (string)view('points.types', [
            'type' => $this->type,
            'items' => $this->getAllPoints(),
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
     * Список родительских категорий
     * @return PointResourceCollection
     */
    public function getAllPoints()
    {
        return new PointResourceCollection(Point::types()->get());
    }
}
