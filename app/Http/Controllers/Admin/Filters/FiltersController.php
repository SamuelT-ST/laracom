<?php namespace App\Http\Controllers\Admin\Filters;

use App\Http\Controllers\Controller;
use App\Shop\Categories\Category;
use App\Shop\Features\Feature;
use App\Shop\Filters\Filter;
use App\Shop\Filters\Requests\IndexFilter;
use App\Shop\Filters\Requests\StoreFilter;
use App\Shop\Filters\Requests\UpdateFilter;
use Illuminate\Http\Response;
use Brackets\AdminListing\Facades\AdminListing;

use Illuminate\Support\Facades\DB;

class FiltersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  IndexFilter $request
     * @return Response|array
     */
    public function index(IndexFilter $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Filter::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'feature_id', 'filter_type'],

            // set columns to searchIn
            ['id', 'filter_type']
        );

        if ($request->ajax()) {
            if($request->has('bulk')){
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.filter.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.filter.create');

        $categories = Category::whereNull('parent_id')->get();

        return view('admin.filter.create')->with(['features' => Feature::all(), 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreFilter $request
     * @return Response|array
     */
    public function store(StoreFilter $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        DB::transaction(function () use ($sanitized){
            // Store the Filter
            $filter = Filter::create($sanitized);
            $filter->categories()->sync($sanitized['categories']);
        });


        if ($request->ajax()) {
            return ['redirect' => url('admin/filters'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/filters');
    }

    /**
     * Display the specified resource.
     *
     * @param  Filter $filter
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Filter $filter)
    {
        $this->authorize('admin.filter.show', $filter);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Filter $filter
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Filter $filter)
    {
        $this->authorize('admin.filter.edit', $filter);

        $filter->load('categories');
        
        $data = collect($filter);
        $data['categories'] = $filter->categories->pluck('id');

        $categories = Category::whereNull('parent_id')->get();

        return view('admin.filter.edit', [
            'filter' => $data,
            'features' => Feature::all(),
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateFilter $request
     * @param  Filter $filter
     * @return Response|array
     */
    public function update(UpdateFilter $request, Filter $filter)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        DB::transaction(function () use ($filter, $sanitized) {
            // Update changed values Filter
            $filter->update($sanitized);
            $filter->categories()->sync($sanitized['categories']);
        });

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/filters'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/filters');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyFilter $request
     * @param  Filter $filter
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy(DestroyFilter $request, Filter $filter)
    {
        $filter->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
    * Remove the specified resources from storage.
    *
    * @param  DestroyFilter $request
    * @return  Response|bool
    * @throws  \Exception
    */
    public function bulkDestroy(DestroyFilter $request) : Response
    {
        DB::transaction(function () use ($request){
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(function($bulkChunk){
                    Filter::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
            });
        });

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }
    
    }
