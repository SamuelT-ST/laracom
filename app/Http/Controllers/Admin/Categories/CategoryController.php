<?php

namespace App\Http\Controllers\Admin\Categories;

use App\Shop\Categories\AdminListing;
use App\Shop\Categories\Requests\CreateCategoryRequest;
use App\Shop\Categories\Requests\IndexCategory;
use App\Shop\Categories\Requests\UpdateCategoryRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Shop\Categories\Category;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexCategory $request
     * @param null $categories
     * @return array|\Illuminate\Http\Response
     */
    public function index(IndexCategory $request, $categories = null)
    {
        $parentId = null;
        $parentName = '';

        if (!is_null($categories)){
            $categories = explode('/', $categories);
            $parent = Category::where('slug', array_pop($categories))->first();
            $parentId = $parent->id;
            $parentName = $parent->name;
        }

        $data = AdminListing::create(Category::class)->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'slug', 'description'],

            // set columns to searchIn
            ['name', 'description'],
            function ($query) use ($parentId){
                $query->where('parent_id', $parentId);
            }
        );

        $breadcrumbs = collect(app('rinvex.categories.category')->ancestorsOf($parentId)->toFlatTree());

        if ($request->ajax()) {
            return ['data' => $data, 'breadcrumbs' => $breadcrumbs, 'parentName' => $parentName];
        }

        return view('admin.categories.list', ['data' => $data, 'breadcrumbs' => $breadcrumbs, 'parentName' => $parentName]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Category|null $category
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category = null)
    {
        return view('admin.categories.create', [
            'categories' => Category::all(),
            'parentCategory' => $category
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {

        $category = Category::create($request->getSanitized());

        $redirectTo = $category->parent ? $category->parent->slug : "";

        if ($request->ajax()) {
            return ['redirect' => url('admin/categories/'. $redirectTo), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect()->route('admin.categories.index')->with('message', 'Category created');
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', [
            'category' => $category,
            'categories' => $category->children,
            'products' => $category->products
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function edit(string $slug)
    {
        $category = Category::with('parent')->where('slug', $slug)->first();

        $category['parent'] = $category->parent;

        return view('admin.categories.edit', [
            'categories' => Category::all(),
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCategoryRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, int $id)
    {
        $category = Category::findOrFail($id);

        $category->update($request->getSanitized());

        $redirectTo = $category->parent ? $category->parent->slug : "";

        if ($request->ajax()){
            return ['redirect' => url('admin/categories/'. $redirectTo), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect()->route('admin.categories.edit', $category->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->route('admin.categories.index');
    }
}
