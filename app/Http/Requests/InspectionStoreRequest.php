<?php

namespace App\Http\Requests;

use Txsoura\Core\Http\Requests\CoreRequest;

class InspectionStoreRequest extends CoreRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'construction_id' => 'required|numeric|exists:constructions,id',
            'seem' => 'required|string|max:255',
        ];
    }
}
