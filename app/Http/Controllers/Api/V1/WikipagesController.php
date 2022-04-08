<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\WikiPage\WikiPageResourceCollection;
use App\Http\Traits\UploadTrait;
use App\Models\Wikipage;
use Illuminate\Http\Request;

class WikipagesController extends Controller
{
    use UploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Wikipage::filter($request->search)
            ->sort($request->sort)
            ->paginate(10);

        return new WikiPageResourceCollection($query);
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
            'parent_id' => 'numeric|nullable',
        ]);

        $model = Wikipage::create($validate);
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
        return Wikipage::select('id', 'title', 'parent_id', 'description')->findOrFail($id);
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
            'parent_id' => 'numeric|nullable',
        ]);

        $model = Wikipage::findOrFail($id);
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
        $model = Wikipage::findOrFail($id);
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
            $folder = '/uploads/images/wikipages/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);

            return json_encode(['url' => $filePath]);
        }

    }
}
