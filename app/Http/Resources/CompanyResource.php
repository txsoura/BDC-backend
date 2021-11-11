<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'tax' => $this->tax,
            'type' => $this->type,
            'workspace' => $this->workspace,
            'cellphone' => $this->cellphone,
            'email' => $this->email,
            'street' => $this->street,
            'postcode' => $this->postcode,
            'number' => $this->number,
            'complement' => $this->complement,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'district' => $this->district,
            'status' => $this->status,
            'subscriptions' => SubscriptionResource::collection($this->whenLoaded('subscriptions')),
            'users' => CompanyUserResource::collection($this->whenLoaded('users')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
