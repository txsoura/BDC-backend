<?php

namespace App\Http\Requests;

use App\Enums\StockFlow;
use Illuminate\Validation\Rule;
use Txsoura\Core\Http\Requests\CoreRequest;

class StockStoreRequest extends CoreRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'quantity' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'flow' => ['required', 'string', Rule::in(StockFlow::toArray())],
            'construction_id' => 'required|numeric|exists:constructions,id',
            'provider_id' => ['required', 'numeric',
                Rule::exists('providers', 'id')
                    ->where('construction_id', $this->construction_id)
            ],
            'product_id' => ['required', 'numeric',
                Rule::exists('products', 'id')
                    ->where('construction_id', $this->construction_id)
            ],
        ];
    }
}
