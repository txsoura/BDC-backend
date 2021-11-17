<?php

namespace App\Http\Requests;

use App\Enums\ConstructionUserRole;
use Illuminate\Validation\Rule;
use Txsoura\Core\Http\Requests\CoreRequest;

class ConstructionUserStoreRequest extends CoreRequest
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
            'company_user_id' => ['required', 'numeric', 'exists:company_users,id',
                Rule::unique('construction_users', 'company_user_id')
                    ->where('construction_id', $this->construction_id)
            ],
            'role' => ['sometimes', 'required', 'string', Rule::in(ConstructionUserRole::toArray())],
        ];
    }
}
