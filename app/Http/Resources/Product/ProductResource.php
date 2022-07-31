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
            'brand' => $this->brand,
            'title' => $this->title,
            'price' => $this->price,
            'description' => $this->description,
            'thumb' => $this->productThumb,
            'images' => $this->images,
            'categories' => $this->categoriesList,
            'attributes' => $this->attributes,
            'visible' => $this->visible,
            'views' => $this->views,
            'slug' => $this->slug,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
