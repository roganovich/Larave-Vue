<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Permissions\PermissionResourceCollection;
use App\Models\Permission;
use App\Models\UsersRole;
use Illuminate\Http\Request;
use App\Models\UsersRolesPermission;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $items = Permission::all();
        $list = [];
        foreach ($items as $item) {
            $path_data = explode('/', $item->route_path);
            $path_data = array_diff($path_data, array(''));
            $module = $item->module;
            $controller = $path_data[2];
            $list[$module][$controller][] = $item;
        }
        return $list;
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

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function saveroles(Request $request, $id)
    {
        $role = UsersRole::findOrFail($id);
        UsersRolesPermission::where(['role_id' => $role->id])->delete();
        foreach ($request->permissions_ids as $key => $permissions_id) {
            $item = new UsersRolesPermission();
            $item->role_id = $role->id;
            $item->permission_id = $permissions_id;
            $item->save();
        }
    }

}
