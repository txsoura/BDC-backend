<?php

namespace App\Http\Requests;

use App\Enums\CompanyType;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Txsoura\Core\Http\Requests\CoreRequest;

class CompanyStoreRequest extends CoreRequest
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
            'type' => ['required', 'string', Rule::in(CompanyType::toArray())],
            'tax' => ['required', 'string',
                Rule::unique('companies', 'tax')
                    ->where('type', $this->type)
            ],
            'workspace' => 'required|string|alpha_dash|max:30',
            'cellphone' => 'sometimes|required|numeric|unique:companies,cellphone',
            'email' => 'required|string|email|unique:companies,email|max:255',
            'street' => 'sometimes|required|string|max:255',
            'postcode' => 'sometimes|required|string|max:255',
            'number' => 'sometimes|required|string|max:255',
            'complement' => 'sometimes|nullable|string|max:255',
            'city' => 'sometimes|required|string|max:255',
            'state' => 'sometimes|required|string|max:255',
            'country' => 'sometimes|required|string|max:255',
            'district' => 'sometimes|required|string|max:255',
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
        ]);

        if ($this->workspace) {
            $this->merge([
                'workspace' => Str::lower($this->workspace),
            ]);
        }

        if ($this->email) {
            $this->merge([
                'email' => Str::lower($this->email),
            ]);
        }

        if ($this->street) {
            $this->merge([
                'street' => ucwords($this->street),
            ]);
        }

        if ($this->city) {
            $this->merge([
                'city' => ucwords($this->city),
            ]);
        }

        if ($this->state) {
            $this->merge([
                'state' => ucwords($this->state),
            ]);
        }

        if ($this->country) {
            $this->merge([
                'country' => ucwords($this->country),
            ]);
        }

        if ($this->district) {
            $this->merge([
                'district' => ucwords($this->district)
            ]);
        }
    }
}
