<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Shop\Couriers\Requests\IndexCourier;
use App\Shop\Couriers\Requests\StoreCourier;
use App\Shop\Couriers\Requests\UpdateCourier;
use App\Shop\Couriers\Requests\DestroyCourier;
use Brackets\AdminListing\Facades\AdminListing;
use App\Shop\Couriers\Courier;
use Illuminate\Support\Facades\DB;

class CouriersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  IndexCourier $request
     * @return Response|array
     */
    public function index(IndexCourier $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Courier::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'from_width', 'from_height', 'from_length', 'url', 'price', 'status'],

            // set columns to searchIn
            ['id', 'name', 'description', 'url']
        );

        if ($request->ajax()) {
            if($request->has('bulk')){
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.courier.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.courier.create');

        return view('admin.courier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCourier $request
     * @return Response|array
     */
    public function store(StoreCourier $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the Courier
        $courier = Courier::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/couriers'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/couriers');
    }

    /**
     * Display the specified resource.
     *
     * @param  Courier $courier
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Courier $courier)
    {
        $this->authorize('admin.courier.show', $courier);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Courier $courier
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Courier $courier)
    {
        $this->authorize('admin.courier.edit', $courier);


        return view('admin.courier.edit', [
            'courier' => $courier,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCourier $request
     * @param  Courier $courier
     * @return Response|array
     */
    public function update(UpdateCourier $request, Courier $courier)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Courier
        $courier->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/couriers'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/couriers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyCourier $request
     * @param  Courier $courier
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy(DestroyCourier $request, Courier $courier)
    {
        $courier->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
    * Remove the specified resources from storage.
    *
    * @param  DestroyCourier $request
    * @return  Response|bool
    * @throws  \Exception
    */
    public function bulkDestroy(DestroyCourier $request) : Response
    {
        DB::transaction(function () use ($request){
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(function($bulkChunk){
                    Courier::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
            });
        });

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }
    
    }
