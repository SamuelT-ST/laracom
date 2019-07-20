<?php

namespace App\Shop\CustomerGroups\Requests;

use App\Shop\Base\BaseFormRequest;

class CreateGroupRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required'],
        ];
    }
}
