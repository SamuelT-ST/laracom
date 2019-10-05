<?php

use App\Shop\Categories\Category;
use App\Shop\Posts\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class PostTableSeeder extends Seeder
{
    public function run(){
        Category::whereParentId(null)->each(function ($category) {

            $faker = Faker::create();
            $file = $faker->image();
            $category->addMedia($file)->toMediaCollection('cover', 'media');

            factory(Post::class, 6)->make()->each(
                function(Post $post) use ($category) {
                    $category->entries(Post::class)->save($post);
                });
        });
    }

}