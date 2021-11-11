<?php

namespace App\Http\Requests;

use App\Enums\CompanyStatus;
use App\Enums\Currency;
use App\Enums\SubscriptionBillingMethod;
use Illuminate\Validation\Rule;
use Txsoura\Core\Http\Requests\CoreRequest;

class SubscriptionStoreRequest extends CoreRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'billing_method' => ['required', 'string', Rule::in(SubscriptionBillingMethod::toArray())],
            'valid_until' => 'required|date|after:today',
            'amount' => 'required|numeric|min:0',
            'company_id' => ['required', 'numeric',
                Rule::exists('companies', 'id')
                    ->where('status', CompanyStatus::APPROVED)
            ],
            'currency' => ['sometimes', 'required', 'string', Rule::in(Currency::toArray())],
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
            'title' => ucwords($this->title),
        ]);
    }
}
