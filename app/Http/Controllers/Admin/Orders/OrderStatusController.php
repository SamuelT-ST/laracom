<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Shop\OrderStatuses\OrderStatus;
use App\Shop\OrderStatuses\Repositories\Interfaces\OrderStatusRepositoryInterface;
use App\Shop\OrderStatuses\Repositories\OrderStatusRepository;
use App\Shop\OrderStatuses\Requests\CreateOrderStatusRequest;
use App\Shop\OrderStatuses\Requests\IndexOrderStatus;
use App\Shop\OrderStatuses\Requests\UpdateOrderStatusRequest;
use Brackets\AdminListing\Facades\AdminListing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderStatusController extends Controller
{
    private $orderStatuses;


    public function __construct(OrderStatusRepositoryInterface $orderStatusRepository)
    {
        $this->orderStatuses = $orderStatusRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexOrderStatus $request
     * @return array|\Illuminate\Http\Response
     */
    public function index(IndexOrderStatus $request)
    {

        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(OrderStatus::class)->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'color'],

            // set columns to searchIn
            ['name', 'color']
        );

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.order-statuses.list', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.order-statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateOrderStatusRequest $request
     * @return array|\Illuminate\Http\Response
     */
    public function store(CreateOrderStatusRequest $request)
    {
        OrderStatus::create($request->validated());

        if ($request->ajax()) {
            return ['redirect' => url('admin/order-statuses'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect()->route('admin.order-statuses.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        return view('admin.order-statuses.edit', ['orderStatus' => $this->orderStatuses->findOrderStatusById($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateOrderStatusRequest $request
     * @param OrderStatus $orderStatus
     * @return array|\Illuminate\Http\Response
     */
    public function update(UpdateOrderStatusRequest $request, OrderStatus $orderStatus)
    {
        $update = new OrderStatusRepository($orderStatus);
        $update->updateOrderStatus($request->validated());

        if ($request->ajax()){
            return ['redirect' => url('admin/order-statuses'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect()->route('admin.order-statuses.edit', $orderStatus->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param OrderStatus $orderStatus
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Request $request, OrderStatus $orderStatus)
    {
        $orderStatus->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->route('admin.order-statuses.index');
    }
}
