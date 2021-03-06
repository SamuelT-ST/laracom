<?php

namespace App\Http\Controllers\Admin\Customers;

use App\Shop\CustomerGroups\CustomerGroup;
use App\Shop\Customers\Customer;
use App\Shop\Customers\Repositories\CustomerRepository;
use App\Shop\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Shop\Customers\Requests\CreateCustomerRequest;
use App\Shop\Customers\Requests\IndexCustomer;
use App\Shop\Customers\Requests\UpdateCustomerRequest;
use App\Shop\Customers\Transformations\CustomerTransformable;
use App\Http\Controllers\Controller;
use Brackets\AdminListing\Facades\AdminListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class CustomerController extends Controller
{
    use CustomerTransformable;

    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepo;

    /**
     * CustomerController constructor.
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepo = $customerRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexCustomer $request
     * @return array|\Illuminate\Http\Response
     */
    public function index(IndexCustomer $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Customer::class)->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'email', 'status'],

            // set columns to searchIn
            ['name', 'email']
        );

        if ($request->ajax()) {
            return ['data' => $data];
        }


        return view('admin.customers.list', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = CustomerGroup::all();

        return view('admin.customers.create')->with(compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCustomerRequest $request
     * @return Customer
     */
    public function store(CreateCustomerRequest $request)
    {
        $sanitized = $request->validated();

        if(!$request->has('password')) {
            $sanitized['password'] = Hash::make(str_random(16));
        }

        $customer = $this->customerRepo->createCustomer($sanitized);

        if ($request->ajax()) {
            return $customer;
        }

        return redirect()->route('admin.customers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('admin.customers.show', [
            'customer' => $customer,
            'addresses' => $customer->addresses
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', ['customer' => $customer, 'groups'=>CustomerGroup::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCustomerRequest $request
     * @param Customer $customer
     * @return array|\Illuminate\Http\Response
     * @throws \App\Shop\Customers\Exceptions\UpdateCustomerInvalidArgumentException
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $update = new CustomerRepository($customer);
        $data = $request->validated();

        if ($request->has('password')) {
            $data['password'] = bcrypt($data['password']);
        }

        $update->updateCustomer($data);

        if ($request->ajax()){
            return ['redirect' => url('admin/customers'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }
        return redirect()->route('admin.customers.edit', $customer->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Customer $customer
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Request $request, Customer $customer)
    {
        $customerRepo = new CustomerRepository($customer);
        $customerRepo->deleteCustomer();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->route('admin.customers.index')->with('message', 'Delete successful');
    }
}
