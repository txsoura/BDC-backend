<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConstructionUserResource extends JsonResource
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
            'role' => $this->role,
            'company_user_id' => $this->company_user_id,
            'company_user' => new CompanyUserResource($this->whenLoaded('companyUser')),
            'construction_id' => $this->construction_id,
            'construction' => new ConstructionResource($this->whenLoaded('construction')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
