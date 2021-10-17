<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockResource extends JsonResource
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
            'quantity' => $this->quantity,
            'price' => $this->price,
            'construction_id' => $this->construction_id,
            'construction' => new ConstructionResource($this->whenLoaded('construction')),
            'provider_id' => $this->provider_id,
            'provider' => new ProviderResource($this->whenLoaded('provider')),
            'product_id' => $this->product_id,
            'product' => new ProductResource($this->whenLoaded('product')),
            'flow' => $this->flow,
            'status' => $this->status,
            'receipt' => $this->receipt,
            'outgoing_receiver' => $this->outgoing_receiver,
            'outgoing_at' => $this->outgoing_at,
            'canceled_at' => $this->canceled_at,
            'arrived_at' => $this->arrived_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
