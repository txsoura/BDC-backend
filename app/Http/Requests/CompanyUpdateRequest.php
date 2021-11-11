<?php

namespace App\Http\Requests;

use App\Enums\CompanyType;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Txsoura\Core\Http\Requests\CoreRequest;

class CompanyUpdateRequest extends CoreRequest
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
            'type' => ['sometimes', 'required', 'string', Rule::in(CompanyType::toArray())],
            'tax' => ['sometimes', 'required', 'string',
                Rule::unique('companies', 'tax')
                    ->where('type', $this->type)
                    ->ignore($this->company)
            ],
            'workspace' => 'sometimes|required|string|alpha_dash|max:30',
            'cellphone' => ['sometimes', 'required', 'numeric',
                Rule::unique('companies', 'cellphone')
                    ->ignore($this->company)
            ],
            'email' => ['sometimes', 'required', 'string', 'email', 'max:255',
                Rule::unique('companies', 'email')
                    ->ignore($this->company)
            ],
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
        if ($this->name) {
            $this->merge([
                'name' => ucwords($this->name),
            ]);
        }

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
