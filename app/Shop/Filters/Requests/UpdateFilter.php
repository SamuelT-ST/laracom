<?php namespace App\Shop\Filters\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateFilter extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.filter.edit', $this->filter);
    }

/**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [
            'feature' => ['sometimes', 'array'],
            'filter_type' => ['sometimes', 'string'],
            'categories' => ['required', 'array']
        ];
    }


    /**
    * Modify input data
    *
    * @return  array
    */
    public function getSanitized(){

        $sanitized = $this->validated();
        $sanitized['feature_id'] = $sanitized['feature']['id'];

        return $sanitized;
    }

}
