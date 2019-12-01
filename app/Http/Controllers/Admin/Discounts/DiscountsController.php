<?php namespace App\Http\Controllers\Admin\Discounts;

use App\Http\Controllers\Controller;
use App\Shop\Categories\Category;
use App\Shop\CustomerGroups\CustomerGroup;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\Discount\IndexDiscount;
use App\Http\Requests\Admin\Discount\StoreDiscount;
use App\Http\Requests\Admin\Discount\UpdateDiscount;
use App\Http\Requests\Admin\Discount\DestroyDiscount;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\Discounts\Discount;
use Illuminate\Support\Facades\DB;

class DiscountsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  IndexDiscount $request
     * @return Response|array
     */
    public function index(IndexDiscount $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Discount::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'description', 'percentage', 'from_margin'],

            // set columns to searchIn
            ['id', 'name', 'description']
        );

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.discount.index', ['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
//        $this->authorize('admin.discount.create');

        return view('admin.discount.create')->with(['customerGroups' => CustomerGroup::all(), 'categories' => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreDiscount $request
     * @return Response|array
     */
    public function store(StoreDiscount $request)
    {
        // Sanitize input
        $sanitized = $request->validated();


        $customerGroups = collect($sanitized['customer_groups'])->map(function ($item){
            return $item['id'];
        });

        $categories = collect($sanitized['categories'])->map(function ($item){
            return $item['id'];
        });

        DB::transaction(function () use ($sanitized, $categories, $customerGroups){
            // Store the Discount
            $discount = Discount::create($sanitized);
            $discount->customerGroups()->sync($customerGroups);
            $discount->categories()->sync($categories);
        });

        if ($request->ajax()) {
            return ['redirect' => url('admin/discounts'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/discounts');
    }

    /**
     * Display the specified resource.
     *
     * @param  Discount $discount
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Discount $discount)
    {
//        $this->authorize('admin.discount.show', $discount);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Discount $discount
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Discount $discount)
    {
//        $this->authorize('admin.discount.edit', $discount);

        return view('admin.discount.edit', [
            'discount' => $discount,
            'customerGroups' => CustomerGroup::all(),
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateDiscount $request
     * @param  Discount $discount
     * @return Response|array
     */
    public function update(UpdateDiscount $request, Discount $discount)
    {
        // Sanitize input
        $sanitized = $request->validated();

        $customerGroups = collect($sanitized['customer_groups'])->map(function ($item){
            return $item['id'];
        });

        $categories = collect($sanitized['categories'])->map(function ($item){
            return $item['id'];
        });

        DB::transaction(function () use ($discount, $sanitized, $customerGroups, $categories){
            // Update changed values Discount
            $discount->update($sanitized);
            $discount->customerGroups()->sync($customerGroups);
            $discount->categories()->sync($categories);
        });


        if ($request->ajax()) {
            return ['redirect' => url('admin/discounts'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/discounts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyDiscount $request
     * @param  Discount $discount
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy(DestroyDiscount $request, Discount $discount)
    {
        DB::transaction(function () use ($discount){
            $discount->customerGroups()->sync([]);
            $discount->categories()->sync([]);
            $discount->delete();
        });

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    }
