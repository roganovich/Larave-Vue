<?php

namespace App\Http\Controllers;

use App\Http\Resources\WikiPage\WikiPageResourceCollection;
use App\Http\Resources\WikiPage\WikiParentResourceCollection;
use App\Models\Wikipage;
use Illuminate\Http\Request;

class WikipagesController extends Controller
{

    /**
     * Родительская категория
     */
    private $parent = null;

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

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param mixed $parent
     */
    public function setParent($parent): void
    {
        $this->parent = $parent;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $parent_id = null)
    {
        if ($parent_id) {
            $this->setParent(Wikipage::findOrFail($parent_id));
            $this->search['parent_id'] = $this->getParent()->id;
        }

        $query = Wikipage::filter($this->search)
            ->sort($this->sort)
            ->paginate(12);

        $items = new WikiPageResourceCollection($query);

        return view('wikipages.index',
            [
                'items' => $items,
                'parent' => $this->getParent(),
                'parentsNav' => $this->getParentsFilter()
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Wikipage::select('id', 'title', 'parent_id', 'description')->findOrFail($id);

        $allParentsCollection = $this->getAllParrents();
        if ($allParentsCollection->where('id', $item->id)->count() > 0) {
            $this->setParent($item);
        } else {
            if ($item->parent) {
                $this->setParent($item->parent);
            }
        }

        return view('wikipages.show', ['item' => $item, 'parentsNav' => $this->getParentsFilter($item)]);
    }

    /**
     * Строим навигацию по родительским категориям
     * @return string
     */
    public function getParentsFilter()
    {
        return (string)view('wikipages.parents', [
            'parent' => $this->getParent(),
            'allParents' => $this->getAllParrents(),
            'total' => $this->getTotal()
        ]);
    }

    /**
     * Количество записей в базе
     * @return int
     */
    public function getTotal()
    {
        return (int)Wikipage::count();
    }

    /**
     * Список родительских категорий
     * @return WikiParentResourceCollection
     */
    public function getAllParrents()
    {
        return new WikiParentResourceCollection(Wikipage::parents()->get());
    }
}
