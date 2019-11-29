<?php namespace App\Shop\FeatureValues\Requests;

use App\Shop\Features\Feature;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreFeatureValue extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.feature-value.create');
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
