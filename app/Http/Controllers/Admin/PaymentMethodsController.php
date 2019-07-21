<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\PaymentMethod\IndexPaymentMethod;
use App\Http\Requests\Admin\PaymentMethod\StorePaymentMethod;
use App\Http\Requests\Admin\PaymentMethod\UpdatePaymentMethod;
use App\Http\Requests\Admin\PaymentMethod\DestroyPaymentMethod;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\PaymentMethod;

class PaymentMethodsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  IndexPaymentMethod $request
     * @return Response|array
     */
    public function index(IndexPaymentMethod $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(PaymentMethod::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'title', 'description', 'price'],

            // set columns to searchIn
            ['id', 'title', 'description']
        );

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.payment-method.index', ['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.payment-method.create');

        return view('admin.payment-method.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePaymentMethod $request
     * @return Response|array
     */
    public function store(StorePaymentMethod $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the PaymentMethod
        $paymentMethod = PaymentMethod::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/payment-methods'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/payment-methods');
    }

    /**
     * Display the specified resource.
     *
     * @param  PaymentMethod $paymentMethod
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(PaymentMethod $paymentMethod)
    {
        $this->authorize('admin.payment-method.show', $paymentMethod);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  PaymentMethod $paymentMethod
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(PaymentMethod $paymentMethod)
    {
        $this->authorize('admin.payment-method.edit', $paymentMethod);

        return view('admin.payment-method.edit', [
            'paymentMethod' => $paymentMethod,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePaymentMethod $request
     * @param  PaymentMethod $paymentMethod
     * @return Response|array
     */
    public function update(UpdatePaymentMethod $request, PaymentMethod $paymentMethod)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Update changed values PaymentMethod
        $paymentMethod->update($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/payment-methods'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/payment-methods');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyPaymentMethod $request
     * @param  PaymentMethod $paymentMethod
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy(DestroyPaymentMethod $request, PaymentMethod $paymentMethod)
    {
        $paymentMethod->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    }
