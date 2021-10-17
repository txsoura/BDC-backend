<?php

namespace App\Http\Requests;

use Txsoura\Core\Http\Requests\CoreRequest;

class ProductUpdateRequest extends CoreRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'notify_when_stock_below' => 'sometimes|required|numeric|min:0|max:99',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        return $this->merge([
            'name' => ucwords($this->name),
        ]);
    }
}
