<?php

namespace App\Http\Requests;

use Txsoura\Core\Http\Requests\CoreRequest;

class InspectionUpdateRequest extends CoreRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'seem' => 'required|string|max:255',
        ];
    }
}
