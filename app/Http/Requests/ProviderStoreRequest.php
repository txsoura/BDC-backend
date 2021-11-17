<?php

namespace App\Http\Requests;

use Txsoura\Core\Http\Requests\CoreRequest;

class ProviderStoreRequest extends CoreRequest
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
