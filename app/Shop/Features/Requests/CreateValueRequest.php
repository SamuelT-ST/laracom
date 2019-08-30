<?php

namespace App\Shop\Features\Requests;

use App\Shop\Features\Feature;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class CreateValueRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('admin.payment-method.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'value' => ['required', $this->getValueType()],
            'featureId' => ['required', 'integer']
        ];
    }

    public function getValueType(){
        return Feature::find($this->featureId)->is_number ? 'integer' : 'string';
    }
}
