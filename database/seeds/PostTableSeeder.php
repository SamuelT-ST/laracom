<?php

use App\Shop\Categories\Category;
use App\Shop\Posts\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostTableSeeder extends Seeder
{
    public function run(){
        Category::whereParentId(null)->each(function ($category) {
            factory(Post::class, 6)->make()->each(
                function(Post $post) use ($category) {
                    $category->entries(Post::class)->save($post);
                });
        });
    }

}