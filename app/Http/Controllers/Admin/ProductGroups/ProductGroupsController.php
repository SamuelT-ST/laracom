<?php namespace App\Http\Controllers\Admin\ProductGroups;

use App\Http\Controllers\Controller;
use App\Shop\ProductGroups\ProductGroup;
use App\Shop\ProductGroups\Repositories\ProductGroupRepository;
use App\Shop\ProductGroups\Requests\DestroyProductGroup;
use App\Shop\ProductGroups\Requests\IndexProductGroup;
use App\Shop\ProductGroups\Requests\StoreProductGroup;
use App\Shop\ProductGroups\Requests\UpdateProductGroup;
use Illuminate\Http\Response;
use Brackets\AdminListing\Facades\AdminListing;
use Illuminate\Support\Facades\DB;

class ProductGroupsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  IndexProductGroup $request
     * @return Response|array
     */
    public function index(IndexProductGroup $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(ProductGroup::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'discount', 'status'],

            // set columns to searchIn
            ['id', 'name', 'description', 'discount']
        );

        if ($request->ajax()) {
            if($request->has('bulk')){
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.product-group.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.product-group.create');

        return view('admin.product-group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreProductGroup $request
     * @return Response|array
     */
    public function store(StoreProductGroup $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        DB::transaction(function() use ($request, $sanitized){
            // Store the ProductGroup
            $productGroup = ProductGroup::create($sanitized);
            $productGroup->products()->sync($request->prepareToSync());
        });

        if ($request->ajax()) {
            return ['redirect' => url('admin/product-groups'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/product-groups');
    }

    /**
     * Display the specified resource.
     *
     * @param  ProductGroup $productGroup
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(ProductGroup $productGroup)
    {
        $this->authorize('admin.product-group.show', $productGroup);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  ProductGroup $productGroup
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(ProductGroup $productGroup)
    {
        $this->authorize('admin.product-group.edit', $productGroup);

        $productGroup = app(ProductGroupRepository::class, ['productGroup'=>$productGroup])->prepareEditData();

        return view('admin.product-group.edit', [
            'productGroup' => $productGroup,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateProductGroup $request
     * @param  ProductGroup $productGroup
     * @return Response|array
     */
    public function update(UpdateProductGroup $request, ProductGroup $productGroup)
    {
        // Sanitize input
        $sanitized = $request->validated();

        DB::transaction(function() use ($request, $sanitized, $productGroup){
            // Store the ProductGroup
            $productGroup->update($sanitized);
            $productGroup->products()->sync([]);
            $productGroup->products()->sync($request->prepareToSync());
        });

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/product-groups'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/product-groups');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyProductGroup $request
     * @param  ProductGroup $productGroup
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy(DestroyProductGroup $request, ProductGroup $productGroup)
    {
        $productGroup->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
    * Remove the specified resources from storage.
    *
    * @param  DestroyProductGroup $request
    * @return  Response|bool
    * @throws  \Exception
    */
    public function bulkDestroy(DestroyProductGroup $request) : Response
    {
        DB::transaction(function () use ($request){
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(function($bulkChunk){
                    ProductGroup::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
            });
        });

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }
    
    }
