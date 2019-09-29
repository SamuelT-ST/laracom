<?php

namespace App\Shop\Cart\Requests;

use App\Shop\Base\BaseFormRequest;
use App\Shop\Couriers\Repositories\CourierRepository;
use App\Shop\OrderStatuses\OrderStatus;
use Gloudemans\Shoppingcart\Facades\Cart;

/**
 * Class CartCheckoutRequest
 * @package App\Shop\Cart\Requests
 * @codeCoverageIgnore
 */
class CartCheckoutRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'courier' => ['required'],
            'customer' => ['nullable'],
            'shipping_address' => ['nullable'],
            'billing_address' => ['nullable'],
            'payment' => ['required', 'array'],
            'customer_name' => ['required', 'string'],
            'customer_email' => ['nullable', 'string'],
            'customer_phone' => ['nullable', 'string'],
            'customer_company' => ['nullable', 'string'],
            'customer_ico' => ['nullable', 'integer'],
            'customer_dic' => ['nullable', 'string'],
            'billing_address_1' => ['required', 'string'],
            'billing_address_2' => ['nullable', 'string'],
            'billing_zip' => ['integer', 'required'],
            'billing_city' => ['string', 'required'],
            'billing_country' => ['array', 'required'],
            'billing_phone' => ['nullable', 'string'],
            'shipping_address_1' => ['nullable', 'string'],
            'shipping_address_2' => ['nullable', 'string'],
            'shipping_zip' => ['nullable', 'string'],
            'shipping_city' => ['nullable', 'string'],
            'shipping_country' => ['nullable', 'array'],
            'shipping_phone' => ['nullable', 'string'],
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

        $sanitized['tax'] = Cart::tax();

        $sanitized['total_products'] = Cart::subtotal();

        $sanitized['total'] = Cart::total()
            + app(CourierRepository::class)->validateCourier($sanitized['courier']['id'])->price
            + app(CourierRepository::class)->validatePaymentMethod($sanitized['payment']['id'])->price;



        $sanitized['order_status_id'] = OrderStatus::where('name', 'pending')->first()->id;
        $sanitized['reference'] = $reference = rand(1,999);
        $sanitized['courier_id'] = $sanitized['courier']['id'];
        $sanitized['shipping_country'] = $sanitized['shipping_country']['id'];
        $sanitized['billing_country'] = $sanitized['billing_country']['id'];
        $sanitized['payment_method_id'] = $sanitized['payment']['id'];
        if (isset($sanitized['shipping_address']) && count($sanitized['shipping_address'])) {
            $sanitized['shipping_address_id'] = $sanitized['shipping_address']['id'];
        } else {
            $sanitized['shipping_address_id'] = null;
        }

        if (isset($sanitized['billing_address']) && count($sanitized['billing_address'])) {
            $sanitized['billing_address_id'] = $sanitized['billing_address']['id'];
        } else {
            $sanitized['billing_address_id'] = null;
        }
        return collect($sanitized)->except('courier', 'customer', 'address', 'shipping_address', 'billing_address')->toArray();

    }

}
