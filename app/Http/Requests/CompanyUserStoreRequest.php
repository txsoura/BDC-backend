<?php

namespace App\Http\Requests;

use App\Enums\CompanyUserRole;
use Illuminate\Validation\Rule;
use Txsoura\Core\Http\Requests\CoreRequest;

class CompanyUserStoreRequest extends CoreRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_id' => 'required|numeric|exists:companies,id',
            'user_id' => ['required', 'numeric', 'exists:users,id',
                Rule::unique('company_users', 'user_id')
                    ->where('company_id', $this->company_id)
            ],
            'role' => ['sometimes', 'required', 'string', Rule::in(CompanyUserRole::toArray())],
        ];
    }
}
