<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class USCitiesTableSeeder extends Seeder
{
    public function run()
    {
        DB::beginTransaction();
        DB::unprepared("
        INSERT INTO cities VALUES ('Aaronsburg', 'PA', null);
                ");
                DB::commit();
            }
        }