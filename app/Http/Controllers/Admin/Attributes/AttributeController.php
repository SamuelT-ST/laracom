<?php

namespace App\Http\Controllers\Admin\Attributes;

use App\Http\Controllers\Controller;
use App\Shop\Attributes\Attribute;
use App\Shop\Attributes\Requests\CreateAttributeRequest;
use App\Shop\Attributes\Requests\UpdateAttributeRequest;
use App\Shop\Attributes\Requests\IndexAttribute;
use Brackets\AdminListing\Facades\AdminListing;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * @param IndexAttribute $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(IndexAttribute $request)
    {

        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Attribute::class)->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            ['id', 'name'],

            // set columns to searchIn
            ['name']
        );

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.attributes.list', compact('data'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.attributes.create');
    }

    /**
     * @param CreateAttributeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateAttributeRequest $request)
    {
        $attribute = Attribute::create($request->validated());

        if ($request->ajax()) {
            return ['redirect' => url('admin/attributes'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect()->route('admin.attributes.edit', $attribute->id);
    }

    /**
     * @param Request $request
     * @param Attribute $attribute
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Support\Collection|\Illuminate\View\View
     */
    public function show(Request $request, Attribute $attribute)
    {

        if ($request->ajax()) {
            return response()->json($attribute->values);
        }

        return view('admin.attributes.show', [
            'attribute' => $attribute,
            'values' => $attribute->values
        ]);
    }

    /**
     * @param Attribute $attribute
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Attribute $attribute)
    {
        return view('admin.attributes.edit', compact('attribute'));
    }

    /**
     * @param UpdateAttributeRequest $request
     * @param Attribute $attribute
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateAttributeRequest $request, Attribute $attribute)
    {
        $attribute->update($request->except('_token'));

        if ($request->ajax()){
            return ['redirect' => url('admin/attributes'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect()->route('admin.attributes.edit', $attribute->id);
    }

    /**
     * @param Request $request
     * @param Attribute $attribute
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(Request $request, Attribute $attribute)
    {
        $attribute->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->route('admin.attributes.index');
    }
}
