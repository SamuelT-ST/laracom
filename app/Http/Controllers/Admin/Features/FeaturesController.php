<?php

namespace App\Http\Controllers\Admin\Features;


use App\Shop\Features\Feature;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Shop\Features\Requests\IndexFeature;
use App\Shop\Features\Requests\StoreFeature;
use App\Shop\Features\Requests\UpdateFeature;
use App\Shop\Features\Requests\DestroyFeature;
use Brackets\AdminListing\Facades\AdminListing;
use Illuminate\Support\Facades\DB;

class FeaturesController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.feature.create');

        return view('admin.feature.create');
    }

    public function loadFeatureValues(Feature $feature){
        return $feature->featureValues;
    }


    public function index(IndexFeature $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Feature::class)->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            ['id', 'title', 'is_number'],

            // set columns to searchIn
            ['id', 'title']
        );

        if ($request->ajax()) {
            if($request->has('bulk')){
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.feature.index', ['data' => $data]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreFeature $request
     * @return Response|array
     */
    public function store(StoreFeature $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the Feature
        $feature = Feature::create($sanitized);

        if ($request->ajax()) {

            return ['redirect' => url('admin/features'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded'), 'model' => $feature];
        }

        return redirect('admin/features');
    }

    /**
     * Display the specified resource.
     *
     * @param  Feature $feature
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Feature $feature)
    {
        $this->authorize('admin.feature.show', $feature);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Feature $feature
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Feature $feature)
    {
        $this->authorize('admin.feature.edit', $feature);

        return view('admin.feature.edit', [
            'feature' => $feature,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateFeature $request
     * @param  Feature $feature
     * @return Response|array
     */
    public function update(UpdateFeature $request, Feature $feature)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Feature
        $feature->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/features'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/features');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyFeature $request
     * @param  Feature $feature
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy(DestroyFeature $request, Feature $feature)
    {
        $feature->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param  DestroyFeature $request
     * @return  Response|bool
     * @throws  \Exception
     */
    public function bulkDestroy(DestroyFeature $request) : Response
    {
        DB::transaction(function () use ($request){
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(function($bulkChunk){
                    Feature::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }
}
