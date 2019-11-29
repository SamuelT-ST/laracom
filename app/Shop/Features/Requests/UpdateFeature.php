<?php namespace App\Shop\Features\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateFeature extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.feature.edit', $this->feature);
    }

/**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [
            'title' => ['sometimes', 'string'],
                        'is_number' => ['sometimes', 'boolean'],
                                ];
    }


    /**
    * Modify input data
    *
    * @return  array
    */
    public function getSanitized()
    {
        $sanitized = $this->validated();


        //Add your code for manipulation with request data here

        return $sanitized;
    }

}
