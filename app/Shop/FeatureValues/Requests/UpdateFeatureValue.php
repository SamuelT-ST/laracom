<?php namespace App\Shop\FeatureValues\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateFeatureValue extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.feature-value.edit', $this->featureValue);
    }

/**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [
            'value' => ['required', $this->getValueType()],
        ];
    }


    public function getValueType(){
        return $this->feature->is_number ? 'integer' : 'string';
    }

    public function getSanitized(){
        $sanitized = $this->validated();

        $sanitized['value_'.$this->getValueType()] = $sanitized['value'];

        return $sanitized;
    }

}
