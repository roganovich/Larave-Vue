<?php

namespace App\Http\Resources\WikiPage;

use Illuminate\Http\Resources\Json\JsonResource;

class WikiPageResource extends JsonResource
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
            'parent_id' => $this->parent_id,
            'parent' => ($this->parent_id) ? $this->parent->title : '',
            'description' => $this->description,
            'updated_at' => $this->updated_at,
        ];
    }
}
