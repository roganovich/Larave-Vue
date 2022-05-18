<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'brand_id' => $this->brand_id,
            'title' => $this->title,
            'description' => $this->description,
            'thumb' => $this->thumb,
            'images' => $this->images,
            'categories' => $this->categories,
            'attributes' => $this->attributes,
            'visible' => $this->visible,
            'views' => $this->views,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
