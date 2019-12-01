<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    public function run(){
        DB::table('settings')->insert([
            [
                'option' => 'FrontPage Banner',
                'option_slug' => str_slug('Frontpage Banner'),
                'value' => '',
                'image' => true
            ],
            [
                'option' => 'Banner 1',
                'option_slug' => str_slug('Banner 1'),
                'value' => '',
                'image' => true
            ],
            [
                'option' => 'Banner 2',
                'option_slug' => str_slug('Banner 2'),
                'value' => '',
                'image' => true
            ],
            [
                'option' => 'Video preview',
                'option_slug' => str_slug('Video preview'),
                'value' => '',
                'image' => false
            ],
            [
                'option' => 'Bottom banner 1',
                'option_slug' => str_slug('Bottom banner 1'),
                'value' => '',
                'image' => false
            ],
            [
                'option' => 'Bottom banner 2',
                'option_slug' => str_slug('Bottom banner 2'),
                'value' => '',
                'image' => false
            ],
        ]);
    }

}