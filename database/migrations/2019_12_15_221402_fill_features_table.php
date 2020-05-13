<?php

use App\Shop\Features\Feature;
use Illuminate\Database\Migrations\Migration;

class FillFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        {

            $data = [
                'Manufacturer style',
                'Collection',
                'TradeMark',
                'Length (cm)',
                'Width (cm)',
                'Height (cm)',
                'Diameter (cm)',
                'Net weight (kg)',
                'Gross weight (kg)',
                'Chain Height (cm)',
                'Bulbs Base',
                'EEC',
                'Base color',
                'Base material',
                'Shade color',
                'Shade material',
                'Bulbs Watt',
                'Kelvin',
                'Lumen',
                'Ip Protection',
                'Bulbs Included',
                'Remote Control Included',
                'With dimmer',
                'Pack lenght (cm)',
                'Pack width (cm)',
                'Pack height (cm)',
            ];

            collect($data)->each(function ($feature){
                Feature::insert(['title' => $feature, 'slug' => \Illuminate\Support\Str::slug($feature)]);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
