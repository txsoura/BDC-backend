<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConstructionResource extends JsonResource
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
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
            'budget' => $this->budget,
            'project' => $this->project,
            'users' => ConstructionUserResource::collection($this->whenLoaded('users')),
            'stages' => StageResource::collection($this->whenLoaded('stages')),
            'inspections' => InspectionResource::collection($this->whenLoaded('inspections')),
            'stocks' => StockResource::collection($this->whenLoaded('stocks')),
            'providers' => ProviderResource::collection($this->whenLoaded('providers')),
            'products' => ProductResource::collection($this->whenLoaded('products')),
            'canceled_at' => $this->canceled_at,
            'started_at' => $this->started_at,
            'finalized_at' => $this->finalized_at,
            'abandoned_at' => $this->abandoned_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
