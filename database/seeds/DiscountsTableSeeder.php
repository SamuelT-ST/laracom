<?php

use App\Models\Discounts\Discount;
use App\Shop\CustomerGroups\CustomerGroup;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DiscountsTableSeeder extends Seeder
{
    /**
     *
     */
    public function run()
    {
        $faker = Faker::create();

        CustomerGroup::all()->each(function($group) use ($faker){
          $group->discount()->insert(factory(Discount::class, 6)->raw());
        });
    }
}