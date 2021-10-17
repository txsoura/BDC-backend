<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'notify_when_stock_below' => $this->notify_when_stock_below,
            'available' => $this->available,
            'construction_id' => $this->construction_id,
            'construction' => new ConstructionResource($this->whenLoaded('construction')),
            'stocks' => StockResource::collection($this->whenLoaded('stocks')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
