<?php

use App\Shop\Attributes\Attribute;
use App\Shop\AttributeValues\AttributeValue;
use App\Shop\CustomerGroups\CustomerGroup;
use Illuminate\Database\Seeder;

class CustomerGroupsTableSeeder extends Seeder
{
    public function run()
    {
        CustomerGroup::insert([
            [
                'title' => 'Guest'
            ],
            [
                'title' => 'Registrovaný'
            ],
            [
                'title' => 'Firma'
            ],
        ]);
    }
}