<?php namespace App\Http\Requests\Admin\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateOrder extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.order.edit', $this->order);
    }

/**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [
        'reference' => ['required', 'string'],
        'courier' => ['required'],
        'customer' => ['required'],
        'address' => ['required'],
        'order_status' => ['required'],
        'payment' => ['nullable', 'string'],
        'discounts' => ['required', 'numeric'],
        'total_products' => ['required', 'numeric'],
        'tax' => ['required', 'numeric'],
        'total' => ['required', 'numeric'],
        'total_paid' => ['required', 'numeric'],
        'invoice' => ['nullable', 'string'],
        'label_url' => ['nullable', 'string'],
        'tracking_number' => ['nullable', 'string'],
        'total_shipping' => ['required', 'numeric'],
        'products'=> ['required', 'array']
    ];
    }
}
