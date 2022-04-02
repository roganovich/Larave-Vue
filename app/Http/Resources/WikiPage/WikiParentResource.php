<?php

namespace App\Http\Resources\WikiPage;

use Illuminate\Http\Resources\Json\JsonResource;

class WikiParentResource extends JsonResource
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
            'count' => $this->count,
        ];
    }
}
