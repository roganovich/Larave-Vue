<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Traits\UploadTrait;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Resources\Order\OrderResourceCollection;

class OrdersController extends Controller
{
    use UploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Order::filter($request->search)
            ->sort($request->sort)
            ->paginate(20);

        return new OrderResourceCollection($query);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        return Order::findOrFail($id);
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
            'amount' => 'numeric',
            'manager_id' => 'numeric|nullable',
            'status' => 'numeric|required',
            'comment' => 'max:255|nullable',
        ]);

        $model = Order::findOrFail($id);
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
        $model = Order::findOrFail($id);
        $model->delete();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function statuseslist()
    {
        return Order::getStatuses()->toArray();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mangerslist()
    {
        return User::select('id', 'name')->where(['role_id'=>1])->orderBy('name', 'ASC')->get();
    }
}
