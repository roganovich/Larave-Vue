<?php

namespace App\Http\Controllers;

use App\Http\Resources\WikiPage\WikiPageResourceCollection;
use App\Http\Resources\WikiPage\WikiParentResourceCollection;
use App\Models\Wikipage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            $search['parent_id'] = $parent->id;
        }
        $sort = [
            'title' => 'ASC',
            'updated_at' => 'ASC'
        ];
        $query = Wikipage::filter($search)
            ->sort($sort)
            ->paginate(12);

        $items = new WikiPageResourceCollection($query);
        $total = Wikipage::count();
        return view('wikipages.index', ['items' => $items, 'total' => $total, 'parent' => $parent, 'parentsFilter' => $this->getAllParrents()]);
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

    public function getAllParrents()
    {
        $query_parents = DB::table('wikipages as t')
            ->join('wikipages as p', 'p.id', '=', 't.parent_id')
            ->select('p.id', 'p.title', DB::raw('count(t.id) as count'))
            ->whereNull('t.deleted_at')
            ->groupBy('p.id', 'p.title')
            ->having(DB::raw('count(t.parent_id)'), '>', 0)
            ->get();
        return new WikiParentResourceCollection($query_parents);
    }
}
