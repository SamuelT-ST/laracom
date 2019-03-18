<?php

namespace App\Http\Controllers\Admin\Couriers;

use App\Shop\Couriers\Courier;
use App\Shop\Couriers\Repositories\CourierRepository;
use App\Shop\Couriers\Repositories\Interfaces\CourierRepositoryInterface;
use App\Shop\Couriers\Requests\CreateCourierRequest;
use App\Shop\Couriers\Requests\IndexCourier;
use App\Shop\Couriers\Requests\UpdateCourierRequest;
use App\Http\Controllers\Controller;
use Brackets\AdminListing\Facades\AdminListing;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    /**
     * @var CourierRepositoryInterface
     */
    private $courierRepo;

    /**
     * CourierController constructor.
     * @param CourierRepositoryInterface $courierRepository
     */
    public function __construct(CourierRepositoryInterface $courierRepository)
    {
        $this->courierRepo = $courierRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return array|\Illuminate\Http\Response
     */
    public function index(IndexCourier $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Courier::class)->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'description', 'url', 'is_free', 'cost', 'status'],

            // set columns to searchIn
            ['name', 'description', 'url', 'cost']
        );

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.couriers.list', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.couriers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCourierRequest $request
     * @return array|\Illuminate\Http\Response
     */
    public function store(CreateCourierRequest $request)
    {
        $this->courierRepo->createCourier($request->all());

        if ($request->ajax()) {
            return ['redirect' => url('admin/couriers'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        $request->session()->flash('message', 'Create successful');
        return redirect()->route('admin.couriers.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        return view('admin.couriers.edit', ['courier' => $this->courierRepo->findCourierById($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCourierRequest  $request
     * @param  int  $id
     * @return array|\Illuminate\Http\Response
     */
    public function update(UpdateCourierRequest $request, $id)
    {
        $courier = $this->courierRepo->findCourierById($id);

        $update = new CourierRepository($courier);
        $update->updateCourier($request->all());

        if ($request->ajax()){
            return ['redirect' => url('admin/couriers'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        $request->session()->flash('message', 'Update successful');
        return redirect()->route('admin.couriers.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $id)
    {
        $courier = $this->courierRepo->findCourierById($id);

        $courierRepo = new CourierRepository($courier);
        $courierRepo->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }


        request()->session()->flash('message', 'Delete successful');
        return redirect()->route('admin.couriers.index');
    }
}
