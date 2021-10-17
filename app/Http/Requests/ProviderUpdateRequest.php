<?php

namespace App\Http\Requests;

use Txsoura\Core\Http\Requests\CoreRequest;

class ProviderUpdateRequest extends CoreRequest
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
