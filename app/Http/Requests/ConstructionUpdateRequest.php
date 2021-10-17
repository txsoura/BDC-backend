<?php

namespace App\Http\Requests;

use Txsoura\Core\Http\Requests\CoreRequest;

class ConstructionUpdateRequest extends CoreRequest
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
            'budget' => 'sometimes|required|numeric|min:0',
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
