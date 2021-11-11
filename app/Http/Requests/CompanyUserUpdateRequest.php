<?php

namespace App\Http\Requests;

use App\Enums\CompanyUserRole;
use Illuminate\Validation\Rule;
use Txsoura\Core\Http\Requests\CoreRequest;

class CompanyUserUpdateRequest extends CoreRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'role' => ['sometimes', 'required', 'string', Rule::in(CompanyUserRole::toArray())],
        ];
    }
}
