<?php

namespace App\Http\Requests;

use App\Enums\UserLang;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Rules\Password;
use Txsoura\Core\Http\Requests\CoreRequest;

class UserStoreRequest extends CoreRequest
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
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => ['required', 'string', new Password],
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
        $this->merge([
            'name' => ucwords($this->name),
            'email' => Str::lower($this->email),
            'password' => Hash::make('12345678'),
        ]);
    }
}
