<?php

namespace App\Http\Requests\Admin\Import;

use App\Rules\IsListPresentRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class ImportInstancesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('admin.translation.edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fileImport' => 'required|file',
            'mappedHeader' => app(IsListPresentRule::class, ['request' => $this]),
            'listIds' => 'nullable'
        ];
    }

    public function getListIds()
    {
        $lists = $this->get('listIds');
        return collect(json_decode($lists))->toArray();
    }
}