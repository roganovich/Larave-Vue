<?php

namespace App\Http\Resources\Point;

use Illuminate\Http\Resources\Json\JsonResource;

class PointResource extends JsonResource
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
            'title' => $this->title,
            'type_id' => $this->type_id,
            'type' => ($this->type) ? $this->type->title : '',
            'description' => $this->description,
            'thumb' => $this->thumb,
            'images' => $this->images,
            'area' => $this->area,
            'country' => $this->country,
            'city' => $this->city,
            'address' => $this->address,
            'map_longitude' => $this->map_longitude,
            'map_latitude' => $this->map_latitude,
            'map_zoom' => $this->map_zoom,
            'days' => $this->days,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
