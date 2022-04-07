<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Point\PointResourceCollection;
use App\Http\Traits\UploadTrait;
use App\Models\Point;
use App\Models\PointsType;
use Illuminate\Http\Request;

class PointsController extends Controller
{
    use UploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Point::filter($request->search)
            ->sort($request->sort)
            ->paginate(20);

        return new PointResourceCollection($query);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function typeslist()
    {
        return PointsType::select('id', 'title')->orderBy('title', 'ASC')->get();
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
            'description' => 'required',
            'country' => 'required',
            'city' => 'required',
            'address' => 'required',
            'map_longitude' => 'required',
            'map_latitude' => 'required',
            'type_id' => 'numeric|nullable',
            'area' => 'numeric|nullable',
            'days' => 'numeric|nullable',
        ]);

        $model = Point::create($validate);
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
        return Point::findOrFail($id);
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
            'title' => 'required|max:255',
            'description' => 'required',
            'country' => 'required',
            'city' => 'required',
            'address' => 'required',
            'map_longitude' => 'required',
            'map_latitude' => 'required',
            'type_id' => 'numeric|nullable',
            'area' => 'numeric|nullable',
            'days' => 'numeric|nullable',
        ]);

        $model = Point::findOrFail($id);
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
        $model = Point::findOrFail($id);
        $model->delete();
    }

    public function addimage(Request $request)
    {
        // Form validation
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Check if a profile image has been uploaded
        if ($request->has('image')) {
            // Get image file
            $image = $request->file('image');
            // Make a image name based on user name and current timestamp
            $name = md5(time());
            // Define folder path
            $folder = '/uploads/images/points/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);

            return json_encode(['url' => $filePath]);
        }

    }
}
