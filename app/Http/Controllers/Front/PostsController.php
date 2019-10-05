<?php

namespace App\Http\Controllers\Front;


use App\Shop\Categories\Category;
use App\Shop\Posts\Post;

class PostsController
{

    public function show($slug){

        $post = Post::where('slug', $slug)->firstOrFail();

        return view('front.post.index')->with(['post' => $post]);
    }

}