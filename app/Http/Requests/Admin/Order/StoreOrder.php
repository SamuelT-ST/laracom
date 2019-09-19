<?php namespace App\Http\Requests\Admin\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreOrder extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.order.create');
    }

/**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [
            'reference' => ['required', Rule::unique('orders', 'reference'), 'string'],
            'courier' => ['required'],
            'customer' => ['required'],
            'shipping_address' => ['nullable'],
            'billing_address' => ['nullable'],
            'order_status' => ['required'],
            'discounts' => ['nullable', 'numeric'],
            'total_products' => ['required', 'numeric'],
            'tax' => ['required', 'numeric'],
            'total' => ['required', 'numeric'],
            'payment' => ['required', 'array'],
            'total_paid' => ['required', 'numeric'],
            'invoice' => ['nullable', 'string'],
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

    public function getSanitized(){
        $sanitized = $this->validated();
        $sanitized['courier_id'] = $sanitized['courier']['id'];
        $sanitized['shipping_country'] = $sanitized['shipping_country']['id'];
        $sanitized['billing_country'] = $sanitized['billing_country']['id'];
        $sanitized['customer_id'] = $sanitized['customer']['id'];
        $sanitized['order_status_id'] = $sanitized['order_status']['id'];
        $sanitized['payment_method_id'] = $sanitized['payment']['id'];
        if (isset($sanitized['shipping_address'])){
            $sanitized['shipping_address_id'] = $sanitized['shipping_address']['id'];
        } else {
            $sanitized['shipping_address_id'] = null;
        }

        if (isset($sanitized['billing_address'])){
            $sanitized['billing_address_id'] = $sanitized['billing_address']['id'];
        } else {
            $sanitized['billing_address_id'] = null;
        }
        return collect($sanitized)->except('courier', 'customer', 'address', 'order_status', 'shipping_address', 'billing_address')->toArray();


//        if(!isset($sanitized['address']['id'])){
//            $sanitized['address']['customer_id'] = $sanitized['customer']['id'];
//            $sanitized['address']['alias'] =  $sanitized['address']['address_1'];
//            $sanitized['address']['country_id'] =  $sanitized['address']['country']['id'];
//            $sanitized['address_id'] = Address::create($sanitized['address'])->id;
//        } else {
//            $sanitized['address_id'] = $sanitized['address']['id'];
//        }

    }
}
