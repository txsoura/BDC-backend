<?php

namespace App\Http\Requests;

use App\Enums\ConstructionUserRole;
use Illuminate\Validation\Rule;
use Txsoura\Core\Http\Requests\CoreRequest;

class ConstructionUserUpdateRequest extends CoreRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'role' => ['sometimes', 'required', 'string', Rule::in(ConstructionUserRole::toArray())],
        ];
    }
}
