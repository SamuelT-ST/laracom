<?php namespace App\Http\Controllers\Admin\Orders;

use App\Http\Controllers\Controller;
use App\Models\Discounts\Discount;
use App\Models\PaymentMethod;
use App\Shop\Addresses\Address;
use App\Shop\Countries\Country;
use App\Shop\Couriers\Courier;
use App\Shop\Customers\Customer;
use App\Shop\OrderProduct\OrderProduct;
use App\Shop\OrderProduct\Repositories\OrderProductRepository;
use App\Shop\OrderProduct\Transformations\OrderProductTransformation;
use App\Shop\OrderStatuses\OrderStatus;
use App\Shop\PaymentMethods\Payment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\Order\IndexOrder;
use App\Http\Requests\Admin\Order\StoreOrder;
use App\Http\Requests\Admin\Order\UpdateOrder;
use App\Http\Requests\Admin\Order\DestroyOrder;
use Brackets\AdminListing\Facades\AdminListing;
use App\Shop\Orders\Order;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  IndexOrder $request
     * @return Response|array
     */
    public function index(IndexOrder $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Order::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'reference', 'customer_name', 'courier_id', 'customer_id', 'billing_address_id', 'order_status_id', 'payment_method_id', 'total_products', 'tax', 'total', 'total_paid', 'invoice', 'courier_id', 'label_url', 'tracking_number', 'total_shipping'],

            // set columns to searchIn
            ['id', 'reference', 'payment', 'invoice', 'courier', 'label_url', 'tracking_number'],
            function (Builder $q){
                $q->with('orderStatus');
            }
        );

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.order.index', ['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.order.create');

        return view('admin.order.create',
            ['customers' => Customer::all(),
            'statuses'=>OrderStatus::all(),
            'couriers'=>Courier::all(),
            'paymentMethods'=>PaymentMethod::all(),
            'countries'=>Country::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreOrder $request
     * @return Response|array
     */
    public function store(StoreOrder $request)
    {

        $sanitized = $request->getSanitized();

        // Store the Order

        DB::transaction(function () use ($sanitized){
            $order = Order::create($sanitized);
            app(OrderProductRepository::class)->createOrderProduct($sanitized['products'], $order);
        });

        if ($request->ajax()) {
            return ['redirect' => url('admin/orders'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/orders');
    }

    /**
     * Display the specified resource.
     *
     * @param  Order $order
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Order $order)
    {
        $this->authorize('admin.order.show', $order);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Order $order
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Order $order)
    {
        $this->authorize('admin.order.edit', $order);

        $order->load('customer', 'orderStatus', 'payment');

        $order['products'] = app(OrderProductTransformation::class)->prepareOrderForUpdate($order);

        return view('admin.order.edit', [
            'order' => $order,
            'customers' => Customer::all(),
            'statuses'=>OrderStatus::all(),
            'couriers'=>Courier::all(),
            'paymentMethods'=>PaymentMethod::all(),
            'countries'=>Country::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateOrder $request
     * @param  Order $order
     * @return Response|array
     */
    public function update(UpdateOrder $request, Order $order)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        DB::transaction(function() use ($order, $sanitized){
            $order->update($sanitized);
            app(OrderProductRepository::class)->updateOrderProduct($sanitized['products'], $order);

        });
        if ($request->ajax()) {
            return ['redirect' => url('admin/orders'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/orders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyOrder $request
     * @param  Order $order
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy(DestroyOrder $request, Order $order)
    {
        $order->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    }
