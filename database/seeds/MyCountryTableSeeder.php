<?php

use App\Shop\Countries\Country;
use Illuminate\Database\Seeder;

class MyCountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('countries')->insert(array (
            1 =>
                array (
                    'id' => '1',
                    'iso' => 'SK',
                    'name' => 'SLOVAKIA',
                    'iso3' => 'SVK',
                    'numcode' => '703',
                    'phonecode' => '421',
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ),
        ));
    }
}
