<?php

namespace App\Http\Controllers\Admin\CustomerGroups;

use App\Shop\CustomerGroups\CustomerGroup;
use App\Shop\CustomerGroups\Requests\CreateGroupRequest;
use App\Shop\CustomerGroups\Requests\UpdateGroupRequest;
use App\Shop\Customers\Requests\CreateCustomerRequest;
use App\Http\Controllers\Controller;
use App\Shop\CustomerGroups\Requests\IndexCustomerGroup;
use Brackets\AdminListing\Facades\AdminListing;
use Illuminate\Http\Request;

class CustomerGroupsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return array|\Illuminate\Http\Response
     */
    public function index(IndexCustomerGroup $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(CustomerGroup::class)->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            ['id', 'title'],

            // set columns to searchIn
            ['title']
        );

        if ($request->ajax()) {
            return ['data' => $data];
        }


        return view('admin.groups.list', ['data' => $data]);
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
     * @return array|\Illuminate\Http\Response
     */
    public function store(CreateGroupRequest $request)
    {
        CustomerGroup::create($request->validated());

        if ($request->ajax()) {
            return ['redirect' => url('admin/customerGroups'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }
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
     * @return array|\Illuminate\Http\Response
     */
    public function update(UpdateGroupRequest $request, CustomerGroup $customerGroup)
    {
        $sanitized = $request->validated();

        $customerGroup->update($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/customerGroups'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        $request->session()->flash('message', 'Update successful');
        return redirect()->route('admin.customerGroups.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param CustomerGroup $customerGroup
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Request $request, CustomerGroup $customerGroup)
    {
        $customerGroup->customers()->sync([]);
        $customerGroup->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }
}
