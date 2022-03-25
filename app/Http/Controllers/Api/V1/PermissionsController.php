<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Permission\PermissionResourceCollection;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $query = Permission::select('id', 'module', 'title', 'route_name', 'route_path', 'route_component')
            ->filter($request->search)
            ->sort($request->sort)
            ->paginate(20);
        return new PermissionResourceCollection($query);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        return Permission::select('id', 'module', 'title', 'route_name', 'route_path', 'route_component')->findOrFail($id);
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
        ]);

        $model = Permission::findOrFail($id);
        $model->update($validate);

        return $model;
    }
}
