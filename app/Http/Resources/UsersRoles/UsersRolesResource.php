<?php

namespace App\Http\Resources\UsersRoles;

use Illuminate\Http\Resources\Json\JsonResource;

class UsersRolesResource extends JsonResource
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
            'title' => ($this->title) ? $this->title : '',
            'is_root' => $this->is_root,
            'permissions' => ($this->permissions) ? $this->permissions : [],
        ];
    }
}
