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
                'option' => 'FrontPage Banner Header',
                'option_slug' => str_slug('FrontPage Banner Header'),
                'value' => '',
                'image' => false
            ],
            [
                'option' => 'FrontPage Banner Text',
                'option_slug' => str_slug('FrontPage Banner Text'),
                'value' => '',
                'image' => false
            ],
            [
                'option' => 'FrontPage Banner Link',
                'option_slug' => str_slug('FrontPage Banner Link'),
                'value' => '',
                'image' => false
            ],
            [
                'option' => 'Banner 1',
                'option_slug' => str_slug('Banner 1'),
                'value' => '',
                'image' => true
            ],
            [
                'option' => 'Banner 1 Link',
                'option_slug' => str_slug('Banner 1 Link'),
                'value' => '',
                'image' => false
            ],
            [
                'option' => 'Banner 2',
                'option_slug' => str_slug('Banner 2'),
                'value' => '',
                'image' => true
            ],
            [
                'option' => 'Banner 2 Link',
                'option_slug' => str_slug('Banner 2 Link'),
                'value' => '',
                'image' => false
            ],
        ]);
    }

}