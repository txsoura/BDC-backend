<?php

namespace App\Http\Requests;

use App\Enums\CompanyStatus;
use Illuminate\Validation\Rule;
use Txsoura\Core\Http\Requests\CoreRequest;

class ConstructionStoreRequest extends CoreRequest
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
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
            'budget' => 'required|numeric|min:0',
            'company_id' => ['required', 'numeric',
                Rule::exists('companies', 'id')
                    ->where('status', CompanyStatus::APPROVED)
            ],
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
    }
}
