<?php

namespace App\Http\Requests;

use App\Enums\ProductType;
use Illuminate\Validation\Rule;
use Txsoura\Core\Http\Requests\CoreRequest;

class ProductStoreRequest extends CoreRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'type' => ['required', 'string', Rule::in(ProductType::toArray())],
            'notify_when_stock_below' => 'required|numeric|min:0|max:99',
            'construction_id' => 'required|numeric|exists:constructions,id',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
         $this->merge([
             'name' => ucwords($this->name),
         ]);
    }
}
