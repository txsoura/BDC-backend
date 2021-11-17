<?php

namespace App\Http\Requests;

use Txsoura\Core\Http\Requests\CoreRequest;

class StageStoreRequest extends CoreRequest
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
            'budget' => 'required|numeric|min:0',
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
