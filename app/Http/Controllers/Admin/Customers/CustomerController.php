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
     * @return array|\Illuminate\Http\Response
     */
    public function store(CreateCustomerRequest $request)
    {
        dd($request->toArray());

        $this->customerRepo->createCustomer($request->except('_token', '_method'));

        if ($request->ajax()) {
            return ['redirect' => url('admin/customers'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect()->route('admin.customers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $customer = $this->customerRepo->findCustomerById($id);
        
        return view('admin.customers.show', [
            'customer' => $customer,
            'addresses' => $customer->addresses
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.customers.edit', ['customer' => $this->customerRepo->findCustomerById($id), 'groups'=>CustomerGroup::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCustomerRequest $request
     * @param  int $id
     * @return array|\Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, $id)
    {
        $customer = $this->customerRepo->findCustomerById($id);

        $update = new CustomerRepository($customer);
        $data = $request->except('_method', '_token', 'password');

        if ($request->has('password')) {
            $data['password'] = bcrypt($request->input('password'));
        }

        $update->updateCustomer($data);

        if ($request->ajax()){
            return ['redirect' => url('admin/customers'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        $request->session()->flash('message', 'Update successful');
        return redirect()->route('admin.customers.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Request $request, $id)
    {
        $customer = $this->customerRepo->findCustomerById($id);

        $customerRepo = new CustomerRepository($customer);
        $customerRepo->deleteCustomer();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->route('admin.customers.index')->with('message', 'Delete successful');
    }
}
