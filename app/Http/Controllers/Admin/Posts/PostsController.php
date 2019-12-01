<?php namespace App\Http\Controllers\Admin\Posts;

use App\Http\Controllers\Controller;
use App\Shop\Categories\Category;
use App\Shop\Posts\Post;
use App\Shop\Posts\Requests\DestroyPost;
use App\Shop\Posts\Requests\IndexPost;
use App\Shop\Posts\Requests\StorePost;
use App\Shop\Posts\Requests\UpdatePost;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Brackets\AdminListing\Facades\AdminListing;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  IndexPost $request
     * @return Response|array
     */
    public function index(IndexPost $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Post::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'title', 'enabled'],

            // set columns to searchIn
            ['id', 'title', 'perex', 'body']
        );

        if ($request->ajax()) {
            if($request->has('bulk')){
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.post.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.post.create');

        $categories = Category::whereNull('parent_id')->get();

        return view('admin.post.create')->with(['categories'=> $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePost $request
     * @return Response|array
     */
    public function store(StorePost $request)
    {
        // Sanitize input
        $sanitized = $request->getValidated();

        DB::transaction(function () use ($sanitized){
            // Store the Post
            $post = Post::create($sanitized);
            $post->categories()->sync($sanitized['categories']);
        });

        if ($request->ajax()) {
            return ['redirect' => url('admin/posts'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  Post $post
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Post $post)
    {
        $this->authorize('admin.post.show', $post);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post $post
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Post $post)
    {
        $this->authorize('admin.post.edit', $post);

        $categories = Category::whereNull('parent_id')->get();
        $post->load('categories');
        $data = collect($post);
        $data['categories'] = $post->categories->pluck('id');

        return view('admin.post.edit', [
            'post' => $data,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePost $request
     * @param  Post $post
     * @return Response|array
     */
    public function update(UpdatePost $request, Post $post)
    {
        $sanitized = $request->getValidated();

        DB::transaction(function () use ($sanitized, $post){
            // Store the Post
            $post->update($sanitized);
            $post->categories()->sync($sanitized['categories']);
        });


        if ($request->ajax()) {
            return [
                'redirect' => url('admin/posts'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyPost $request
     * @param  Post $post
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy(DestroyPost $request, Post $post)
    {
        $post->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
    * Remove the specified resources from storage.
    *
    * @param  DestroyPost $request
    * @return  Response|bool
    * @throws  \Exception
    */
    public function bulkDestroy(DestroyPost $request) : Response
    {
        DB::transaction(function () use ($request){
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(function($bulkChunk){
                    Post::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
            });
        });

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }
    
    }
