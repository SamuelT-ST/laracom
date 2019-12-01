<?php

namespace App\Http\Controllers\Admin\Addresses;

use App\Shop\Addresses\Address;
use App\Shop\Addresses\Requests\CreateAddressRequest;
use App\Shop\Addresses\Requests\UpdateAddressRequest;
use App\Shop\Addresses\Transformations\AddressTransformable;
use App\Shop\Countries\Country;
use App\Shop\Customers\Customer;
use App\Http\Controllers\Controller;
use App\Shop\Addresses\Requests\IndexAddress;
use Brackets\AdminListing\Facades\AdminListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    use AddressTransformable;

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return array|\Illuminate\Http\Response
     */
    public function index(IndexAddress $request)
    {

        $data = AdminListing::create(Address::class)->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            ['id', 'alias', 'customer_id', 'country_id', 'address_1', 'city', 'zip', 'status'],

            // set columns to searchIn
            ['alias', 'address_1', 'city', 'zip', 'status']
        );

        if ($request->ajax()) {
            return ['data' => $data];
        }


        return view('admin.addresses.list', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.addresses.create', [
//            TODO customerov nacitat postupne, nie naraz!
            'customers' => Customer::all(),
            'countries' => Country::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateAddressRequest $request
     * @return array|\Illuminate\Http\Response
     */
    public function store(CreateAddressRequest $request)
    {
        Address::create($request->getSanitized());

        if ($request->ajax()) {
            return ['redirect' => url('admin/addresses'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect()->route('admin.addresses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * Show the form for editing the specified resource.
     *
     * @param Address $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        $countries = Country::all();
        $customer = $address->customer;

        return view('admin.addresses.edit', [
            'address' => $address,
            'countries' => $countries,
            'countryId' => $address->country->id,
            'customers' => Customer::all(),
            'customer' => $customer
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateAddressRequest $request
     * @param Address $address
     * @return array|\Illuminate\Http\Response
     */
    public function update(UpdateAddressRequest $request, Address $address)
    {
        $address->update($request->getSanitized());

        if ($request->ajax()){
            return ['redirect' => url('admin/addresses'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        $request->session()->flash('message', 'Update successful');
        return redirect()->route('admin.addresses.edit', $address->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Address $address
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Request $request, Address $address)
    {
        DB::transaction(function () use ($address){
            $address->customer()->dissociate();
            $address->delete();
        });

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->route('admin.addresses.index');
    }

    public function getAvailableAddresses(Customer $customer){
        return $customer->addresses;
    }
}
