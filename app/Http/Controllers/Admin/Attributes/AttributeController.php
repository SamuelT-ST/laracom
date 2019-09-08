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
        $attribute = Attribute::create($request->except('_token'));

        $request->session()->flash('message', 'Create attribute successful!');

        if ($request->ajax()) {
            return ['redirect' => url('admin/attributes'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect()->route('admin.attributes.edit', $attribute->id);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Support\Collection|\Illuminate\View\View
     */
    public function show(Request $request, $id)
    {

        $attribute = Attribute::findOrFail($id);

        if ($request->ajax()) {
            return response()->json($attribute->values);
        }

        return view('admin.attributes.show', [
            'attribute' => $attribute,
            'values' => $attribute->values
        ]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $attribute = Attribute::findOrFail($id);

        return view('admin.attributes.edit', compact('attribute'));
    }

    /**
     * @param UpdateAttributeRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateAttributeRequest $request, $id)
    {
        $attribute = Attribute::findOrFail($id);

        $attribute->update($request->except('_token'));

        $request->session()->flash('message', 'Attribute update successful!');

        if ($request->ajax()){
            return ['redirect' => url('admin/attributes'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect()->route('admin.attributes.edit', $attribute->id);
    }

    /**
     * @param Request $request
     * @param $id
     * @return bool|null
     */
    public function destroy(Request $request, $id)
    {
        Attribute::findOrFail($id)->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        request()->session()->flash('message', 'Attribute deleted successfully!');

        return redirect()->route('admin.attributes.index');
    }
}
