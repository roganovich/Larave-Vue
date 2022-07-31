<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'amount' => $this->amount,
            'status' => $this->statusName,
            'manager' => $this->manager,
            'user_id' => $this->user_id,
            'point_id' => $this->point_id,
            'comment' => $this->comment,
            'manager_id' => $this->manager_id,
            'created_at' => $this->created_at
        ];
    }
}
