<?php

namespace App\Http\Controllers\Admin\Addresses;

use App\Shop\Addresses\Address;
use App\Shop\Addresses\Repositories\AddressRepository;
use App\Shop\Addresses\Repositories\Interfaces\AddressRepositoryInterface;
use App\Shop\Addresses\Requests\CreateAddressRequest;
use App\Shop\Addresses\Requests\UpdateAddressRequest;
use App\Shop\Addresses\Transformations\AddressTransformable;
use App\Shop\Cities\City;
use App\Shop\Cities\Repositories\Interfaces\CityRepositoryInterface;
use App\Shop\Countries\Country;
use App\Shop\Countries\Repositories\CountryRepository;
use App\Shop\Countries\Repositories\Interfaces\CountryRepositoryInterface;
use App\Shop\Customers\Customer;
use App\Shop\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Shop\Addresses\Requests\IndexAddress;
use App\Shop\Provinces\Repositories\Interfaces\ProvinceRepositoryInterface;
use Brackets\AdminListing\Facades\AdminListing;
use Illuminate\Http\Request;

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

        $request['country_id'] = $request['country']['id'];
        $request['customer_id'] = $request['customer']['id'];

        Address::create($request->except('_token', '_method'));

        if ($request->ajax()) {
            return ['redirect' => url('admin/addresses'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        $request->session()->flash('message', 'Creation successful');
        return redirect()->route('admin.addresses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return view('admin.addresses.show', ['address' => Address::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $countries = Country::all();
        $address = Address::findOrFail($id);
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
     * @param  int  $id
     * @return array|\Illuminate\Http\Response
     */
    public function update(UpdateAddressRequest $request, $id)
    {
        $address = Address::findOrFail($id);

        $request['country_id'] = $request['country']['id'];
        $request['customer_id'] = $request['customer']['id'];

        $address->update($request->except('_method', '_token'));

        if ($request->ajax()){
            return ['redirect' => url('admin/addresses'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        $request->session()->flash('message', 'Update successful');
        return redirect()->route('admin.addresses.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $address = Address::findOrFail($id);

        $address->customer()->dissociate();

        $address->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        request()->session()->flash('message', 'Delete successful');
        return redirect()->route('admin.addresses.index');
    }
}
