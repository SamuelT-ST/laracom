<?php

use App\Shop\Categories\Category;
use App\Shop\Products\Product;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Faker\Factory as Faker;

class CategoryProductsTableSeeder extends Seeder
{

    public function run()
    {
        Category::all()->each(function (Category $category) {
            factory(Product::class, 6)->make()->each(
                function(Product $product) use ($category) {
                $faker = Faker::create();

                $file = $faker->image();
                $file2 = $faker->image();
                $product->addMedia($file)->toMediaCollection('cover', 'media');
                $product->addMedia($file2)->toMediaCollection('images', 'media');
                $category->entries(Product::class)->save($product);
            });
        });
    }
}