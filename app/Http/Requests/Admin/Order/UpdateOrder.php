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
        'shipping_address' => ['nullable'],
        'billing_address' => ['nullable'],
        'order_status' => ['required'],
        'payment' => ['required', 'array'],
        'discounts' => ['required', 'numeric'],
        'total_products' => ['required', 'numeric'],
        'tax' => ['required', 'numeric'],
        'total' => ['required', 'numeric'],
        'total_paid' => ['required', 'numeric'],
        'invoice' => ['nullable', 'string'],
        'label_url' => ['nullable', 'string'],
        'tracking_number' => ['nullable', 'string'],
        'total_shipping' => ['required', 'numeric'],
        'products'=> ['required', 'array'],
        'customer_name'=> ['required', 'string'],
        'customer_email'=> ['nullable', 'string'],
        'customer_phone'=> ['nullable', 'string'],
        'customer_company'=> ['nullable', 'string'],
        'customer_ico'=> ['nullable', 'integer'],
        'customer_dic'=> ['nullable', 'string'],
        'billing_address_1'=> ['required', 'string'],
        'billing_address_2'=> ['nullable', 'string'],
        'billing_zip'=> ['integer', 'required'],
        'billing_city'=> ['string', 'required'],
        'billing_country'=> ['array', 'required'],
        'billing_phone'=> ['nullable', 'string'],
        'shipping_address_1'=> ['nullable', 'string'],
        'shipping_address_2'=> ['nullable', 'string'],
        'shipping_zip'=> ['nullable', 'string'],
        'shipping_city'=> ['nullable', 'string'],
        'shipping_country'=> ['nullable', 'array'],
        'shipping_phone'=> ['nullable', 'string'],
        "shipping_customer_name" => ['nullable', 'string'],
        "shipping_customer_email" => ['nullable', 'string'],
        "shipping_customer_phone" => ['nullable', 'string'],
        "shipping_customer_company" => ['nullable', 'string'],
        "shipping_customer_ico" => ['nullable', 'string'],
        "shipping_customer_dic" => ['nullable', 'string'],
        "same_addresses" => ['boolean'],

    ];
    }

    public function getSanitized()
    {

        $sanitized = $this->validated();
        $sanitized['courier_id'] = $sanitized['courier']['id'];
        $sanitized['shipping_country'] = $sanitized['shipping_country']['id'];
        $sanitized['billing_country'] = $sanitized['billing_country']['id'];
        $sanitized['customer_id'] = $sanitized['customer']['id'];
        $sanitized['order_status_id'] = $sanitized['order_status']['id'];
        $sanitized['payment_method_id'] = $sanitized['payment']['id'];
        if (isset($sanitized['shipping_address'])) {
            $sanitized['shipping_address_id'] = $sanitized['shipping_address']['id'];
        } else {
            $sanitized['shipping_address_id'] = null;
        }

        if (isset($sanitized['billing_address'])) {
            $sanitized['billing_address_id'] = $sanitized['billing_address']['id'];
        } else {
            $sanitized['billing_address_id'] = null;
        }

        return collect($sanitized)->except('courier', 'customer', 'address', 'order_status')->toArray();
    }
}
