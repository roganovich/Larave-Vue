<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UsersRoles\UsersRolesResourceCollection;
use App\Models\UsersRole;
use App\Models\UsersRolesPermission;
use Illuminate\Http\Request;

class UsersRolesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = UsersRole::filter($request->search)
            ->sort($request->sort)
            ->paginate(20);

        return new UsersRolesResourceCollection($query);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        return UsersRole::all();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        return UsersRole::findOrFail($id);
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
            'is_root' => 'boolean',
        ]);

        $model = UsersRole::create($validate);
        return $model;
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
            'title' => 'required|max:256',
            'is_root' => 'boolean',
        ]);

        $model = UsersRole::findOrFail($id);
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
        $model = UsersRole::findOrFail($id);
        // Remove the specified resource from storage.
        UsersRolesPermission::where(['role_id' => $model->id])->delete();
        $model->delete();
    }
}
