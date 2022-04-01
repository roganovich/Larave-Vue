<?php

namespace App\Http\Controllers;

use App\Http\Resources\WikiPage\WikiPageResourceCollection;
use App\Models\Wikipage;
use Illuminate\Http\Request;

class WikipagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $parent_id = null)
    {
        $search = [];
        $parent = null;
        if ($parent_id) {
            $parent = Wikipage::findOrFail($parent_id);
            $search['parent_id'] =  $parent->id;
        }
        $sort = [
            'title' => 'ASC',
            'updated_at' => 'ASC'
        ];
        $query = Wikipage::filter($search)
            ->sort($sort)
            ->paginate(12);

        $items = new WikiPageResourceCollection($query);

        return view('wikipages.index', ['items' => $items, 'parent' => $parent]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function parentlist()
    {
        return new WikiPageResourceCollection(Wikipage::select('id', 'title')->orderBy('title', 'ASC')->get());
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
        return view('wikipages.show', ['item' => $item]);
    }
}
