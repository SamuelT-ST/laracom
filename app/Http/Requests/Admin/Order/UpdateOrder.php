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
            'reference' => ['sometimes', Rule::unique('orders', 'reference')->ignore($this->order->getKey(), $this->order->getKeyName()), 'string'],
            'courier_id' => ['sometimes', 'integer'],
            'customer_id' => ['sometimes', 'integer'],
            'address_id' => ['sometimes', 'integer'],
            'order_status_id' => ['sometimes', 'integer'],
            'payment' => ['sometimes', 'string'],
            'discounts' => ['sometimes', 'numeric'],
            'total_products' => ['sometimes', 'numeric'],
            'tax' => ['sometimes', 'numeric'],
            'total' => ['sometimes', 'numeric'],
            'total_paid' => ['sometimes', 'numeric'],
            'invoice' => ['nullable', 'string'],
            'courier' => ['nullable', 'string'],
            'label_url' => ['nullable', 'string'],
            'tracking_number' => ['nullable', 'string'],
            'total_shipping' => ['sometimes', 'numeric'],
            
        ];
    }
}
