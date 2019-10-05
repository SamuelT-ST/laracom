<?php namespace App\Shop\Posts\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StorePost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.post.create');
    }

/**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string'],
            'perex' => ['nullable', 'string'],
            'body' => ['nullable', 'string'],
            'enabled' => ['required', 'boolean'],
            'categories'=>['required', 'array']
                        
        ];
    }

    public function getValidated(){
        $sanitized = $this->validated();
        $sanitized['slug'] = str_slug($sanitized['title']);

        return $sanitized;
    }
}
