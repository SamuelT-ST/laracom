<?php namespace App\Shop\Couriers\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateCourier extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.courier.edit', $this->courier);
    }

/**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [
            'name' => ['sometimes', 'string'],
                        'description' => ['nullable', 'string'],
                        'from_width' => ['nullable', 'integer'],
                        'from_height' => ['nullable', 'integer'],
                        'from_length' => ['nullable', 'integer'],
                        'url' => ['nullable', 'string'],
                        'price' => ['nullable', 'integer'],
                        'status' => ['sometimes', 'boolean'],
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
