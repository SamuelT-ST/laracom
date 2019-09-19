<?php

namespace App\Shop\Orders;

use App\Models\PaymentMethod;
use App\Shop\Addresses\Address;
use App\Shop\Countries\Country;
use App\Shop\Couriers\Courier;
use App\Shop\Customers\Customer;
use App\Shop\OrderProduct\OrderProduct;
use App\Shop\OrderStatuses\OrderStatus;
use App\Shop\Products\Product;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Order extends Model
{
    use SearchableTrait;

    /**
     * Searchable rules.
     *
     * Columns and their priority in search results.
     * Columns with higher values are more important.
     * Columns with equal values have equal importance.
     *
     * @var array
     */
    protected $searchable = [
        'columns' => [
            'customers.name' => 10,
            'orders.reference' => 8,
            'products.name' => 5
        ],
        'joins' => [
            'customers' => ['customers.id', 'orders.customer_id'],
            'order_product' => ['orders.id', 'order_product.order_id'],
            'products' => ['products.id', 'order_product.product_id'],
        ],
        'groupBy' => ['orders.id']
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reference',
        'courier_id', // @deprecated
        'courier',
        'customer_id',
        'address_id',
        'order_status_id',
        'payment_method_id',
        'discounts',
        'total_products',
        'total',
        'tax',
        'total_paid',
        'invoice',
        'label_url',
        'tracking_number',
        'total_shipping',
        "shipping_customer_name",
        "shipping_customer_email",
        "shipping_customer_phone",
        "shipping_customer_company",
        "shipping_customer_ico",
        "shipping_customer_dic",
        "same_addresses",
        "customer_name",
        "customer_email",
        "customer_phone",
        "customer_company",
        "customer_ico",
        "customer_dic",
        "billing_address_1",
        "billing_address_2",
        "billing_zip",
        "billing_city",
        "billing_country",
        "billing_phone",
        "shipping_address_1",
        "shipping_address_2",
        "shipping_zip",
        "shipping_city",
        "shipping_country",
        "shipping_phone",
        "billing_address_id",
        "shipping_address_id"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    protected $with = ['shippingAddress', 'billingAddress', 'courier', 'orderStatus', 'billingCountry', 'shippingCountry', 'payment'];
    protected $appends = ['resource_url'];


    public function getResourceUrlAttribute() {
        return url('/admin/orders/'.$this->getKey());
    }

//    /**
//     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
//     */
//    public function products()
//    {
//        return $this->belongsToMany(Product::class)
//                    ->withPivot([
//                        'quantity',
//                        'product_name',
//                        'product_sku',
//                        'product_description',
//                        'product_price',
//                        'product_attribute_id'
//                    ]);
//    }

    public function orderProduct(){
        return $this->hasMany(OrderProduct::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function courier()
    {
        return $this->belongsTo(Courier::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function billingAddress(){
        return $this->belongsTo(Address::class);
    }

    public function shippingAddress(){
        return $this->belongsTo(Address::class);
    }

    public function billingCountry(){
        return $this->belongsTo(Country::class, 'billing_country');
    }

    public function shippingCountry(){
        return $this->belongsTo(Country::class, 'shipping_country');
    }

    public function payment(){
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    /**
     * @param string $term
     *
     * @return mixed
     */
    public function searchForOrder(string $term)
    {
        return self::search($term);
    }
}
