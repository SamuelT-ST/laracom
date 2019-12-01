<?php namespace App\Http\Controllers\Admin\FeatureValues;

use App\Http\Controllers\Controller;
use App\Shop\Features\Feature;
use App\Shop\FeatureValues\FeatureValue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Response;
use App\Shop\FeatureValues\Requests\IndexFeatureValue;
use App\Shop\FeatureValues\Requests\StoreFeatureValue;
use App\Shop\FeatureValues\Requests\UpdateFeatureValue;
use App\Shop\FeatureValues\Requests\DestroyFeatureValue;
use Brackets\AdminListing\Facades\AdminListing;
use Illuminate\Support\Facades\DB;

class FeatureValuesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param Feature $feature
     * @param  IndexFeatureValue $request
     * @return Response|array
     */
    public function index(Feature $feature, IndexFeatureValue $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(FeatureValue::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'value_string', 'value_integer', 'feature_id'],

            // set columns to searchIn
            ['id', 'value_string'],
            function (Builder $query) use ($feature){
                $query->with('feature')->whereHas('feature', function ($q) use ($feature) {
                    $q->where('id', $feature->id);
                });
            }
        );

        if ($request->ajax()) {
            if($request->has('bulk')){
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.feature-value.index', ['data' => $data, 'feature' => $feature]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Feature $feature
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Feature $feature)
    {
        $this->authorize('admin.feature-value.create');

        return view('admin.feature-value.create')->with(['feature' => $feature]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Feature $feature
     * @param  StoreFeatureValue $request
     * @return Response|array
     */
    public function store(Feature $feature, StoreFeatureValue $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the FeatureValue
        $featureValue = $feature->featureValues()->create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => route('admin/feature-values/index', $feature->id), 'message' => trans('brackets/admin-ui::admin.operation.succeeded'), 'model' => $featureValue];
        }

        return redirect(route('admin/feature-values/index', $feature->id));
    }

    /**
     * Display the specified resource.
     *
     * @param Feature $feature
     * @param  FeatureValue $featureValue
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Feature $feature, FeatureValue $featureValue)
    {
        $this->authorize('admin.feature-value.show', $featureValue);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Feature $feature
     * @param  FeatureValue $featureValue
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Feature $feature, FeatureValue $featureValue)
    {
        $this->authorize('admin.feature-value.edit', $featureValue);


        return view('admin.feature-value.edit', [
            'featureValue' => $featureValue,
            'feature' => $feature
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Feature $feature
     * @param  UpdateFeatureValue $request
     * @param  FeatureValue $featureValue
     * @return Response|array
     */
    public function update(Feature $feature, UpdateFeatureValue $request, FeatureValue $featureValue)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values FeatureValue
        $featureValue->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => route('admin/feature-values/index', $feature->id),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect(route('admin/feature-values/index', $feature->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Feature $feature
     * @param  DestroyFeatureValue $request
     * @param  FeatureValue $featureValue
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy(Feature $feature, DestroyFeatureValue $request, FeatureValue $featureValue)
    {
        $featureValue->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
    * Remove the specified resources from storage.
    *
    * @param  DestroyFeatureValue $request
    * @return  Response|bool
    * @throws  \Exception
    */
    public function bulkDestroy(DestroyFeatureValue $request) : Response
    {
        DB::transaction(function () use ($request){
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(function($bulkChunk){
                    FeatureValue::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
            });
        });

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }
    
    }
