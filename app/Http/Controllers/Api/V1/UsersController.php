<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Users\UsersResource;
use App\Http\Resources\Users\UsersResourceCollection;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = User::select('id', 'name', 'email', 'email_verified_at', 'created_at')
            ->filter($request->search)
            ->sort($request->sort)
            ->paginate(20);
        return new UsersResourceCollection($query);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:256',
            'password' => 'min:6|required_with:password2|same:password2',
            'password2' => 'min:6'
        ]);

        if ($password = Arr::get($validate, 'password'))
            $validate['password'] = Hash::make($password);

        $model = User::create($validate);
        return $model;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        return User::select('id', 'name', 'email', 'email_verified_at', 'created_at')->findOrFail($id);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:256',
            'password' => 'min:6|same:password2',
            'password2' => 'min:6'
        ]);

        if ($password = Arr::get($validate, 'password'))
            $validate['password'] = Hash::make($password);

        $model = User::findOrFail($id);
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
        $model = User::findOrFail($id);
        $model->delete();
        return '';
    }
}
