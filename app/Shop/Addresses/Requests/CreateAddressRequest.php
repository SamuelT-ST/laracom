<?php

namespace App\Shop\Addresses\Requests;

use App\Shop\Base\BaseFormRequest;

class CreateAddressRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'alias' => ['required', 'string'],
            'customer' => ['array', 'required'],
            'address_1' => ['required', 'string'],
            'address_2' => ['nullable', 'string'],
            'zip' => ['required', 'string'],
            'city' => ['required', 'string'],
            'country' => ['required', 'array'],
            'phone' => ['required', 'string'],
            'status' => ['nullable'],
        ];
    }

    public function getSanitized(){

        $sanitized = $this->validated();

        $sanitized['country_id'] = $sanitized['country']['id'];
        $sanitized['customer_id'] = $sanitized['customer']['id'];

        return $sanitized;

    }
}
