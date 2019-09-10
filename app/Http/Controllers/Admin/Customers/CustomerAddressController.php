<?php

namespace App\Http\Controllers\Admin\Customers;

use App\Shop\Addresses\Address;
use App\Http\Controllers\Controller;
use App\Shop\Countries\Country;
use App\Shop\Customers\Customer;
use Illuminate\Http\Request;

class CustomerAddressController extends Controller
{

    /**
     * Show the customer's address
     *
     * @param int $customerId
     * @param int $addressId
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $customerId, int $addressId, Request $request)
    {

        if($request->ajax()){
            return Address::find($addressId);
        }

        return view('admin.addresses.customers.show', [
            'address' => Address::find($addressId),
            'customerId' => $customerId
        ]);
    }

    /**
     * Show the edit form
     *
     * @param int $customerId
     * @param int $addressId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $customerId, int $addressId)
    {
        $country = Country::find(env('COUNTRY_ID', 1));

        return view('admin.addresses.customers.edit', [
            'country' => $country,
            'address' => Address::find($addressId),
            'countries' => Country::all(),
            'customerId' => $customerId
        ]);
    }

    public function getAvailableAddresses(Customer $customer){
        return $customer->addresses;
    }
}
