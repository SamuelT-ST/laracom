<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TranslationsTableSeeder extends Seeder
{
    public function run(){
        DB::table('translations')->insert([
            'namespace' => '*',
            'group' => 'home',
            'key' => 'category.discount',
            'text' => '{"sk": "3"}',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ],
        [
            'namespace' => '*',
            'group' => 'home',
            'key' => 'category.special',
            'text' => '{"sk": "4"}',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ],
        [
            'namespace' => '*',
            'group' => 'home',
            'key' => 'category.bestsellers',
            'text' => '{"sk": "1"}',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ],
        [
            'namespace' => '*',
            'group' => 'home',
            'key' => 'category.new',
            'text' => '{"sk": "2"}',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }

}