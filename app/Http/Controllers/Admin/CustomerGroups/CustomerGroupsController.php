<?php

namespace App\Http\Controllers\Admin\CustomerGroups;

use App\Shop\CustomerGroups\CustomerGroup;
use App\Shop\CustomerGroups\Requests\CreateGroupRequest;
use App\Shop\CustomerGroups\Requests\UpdateGroupRequest;
use App\Shop\Customers\Requests\CreateCustomerRequest;
use App\Http\Controllers\Controller;

class CustomerGroupsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.groups.list')->withGroups(CustomerGroup::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCustomerRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateGroupRequest $request)
    {
        CustomerGroup::create($request->validated());
        return redirect()->route('admin.customerGroups.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param CustomerGroup $customerGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerGroup $customerGroup)
    {
        return view('admin.groups.edit')->withGroup($customerGroup);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateGroupRequest $request
     * @param CustomerGroup $customerGroup
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGroupRequest $request, CustomerGroup $customerGroup)
    {
        $sanitized = $request->validated();

        $customerGroup->update($sanitized);

        $request->session()->flash('message', 'Update successful');
        return redirect()->route('admin.customerGroups.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CustomerGroup $customerGroup
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(CustomerGroup $customerGroup)
    {
        $customerGroup->delete();
        return redirect()->back();
    }
}
