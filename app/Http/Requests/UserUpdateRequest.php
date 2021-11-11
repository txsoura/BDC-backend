<?php

namespace App\Http\Requests;

use App\Enums\UserLang;
use App\Enums\UserRole;
use Illuminate\Validation\Rule;
use Txsoura\Core\Http\Requests\CoreRequest;

class UserUpdateRequest extends CoreRequest
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
            'role' => ['sometimes', 'required', 'string', Rule::in(UserRole::toArray())],
            'lang' => ['sometimes', 'required', 'string', Rule::in(UserLang::toArray())],
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if ($this->name) {
            $this->merge([
                'name' => ucwords($this->name),
            ]);
        }
    }
}
