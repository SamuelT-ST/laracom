<?php

use App\Shop\Attributes\Attribute;
use App\Shop\AttributeValues\AttributeValue;
use Illuminate\Database\Seeder;

class AttributeTableSeeder extends Seeder
{
    public function run()
    {
        $sizeAttr = factory(Attribute::class)->create(['name' => 'Farba svetla']);
        factory(AttributeValue::class)->create([
            'value' => 'teplá biela',
            'attribute_id' => $sizeAttr->id
        ]);

        factory(AttributeValue::class)->create([
            'value' => 'studená biela',
            'attribute_id' => $sizeAttr->id
        ]);

        factory(AttributeValue::class)->create([
            'value' => 'denná biela',
            'attribute_id' => $sizeAttr->id
        ]);

        $colorAttr = factory(Attribute::class)->create(['name' => 'Počet prijímačov']);

        factory(AttributeValue::class)->create([
            'value' => 'Bez prijímača',
            'attribute_id' => $colorAttr->id
        ]);

        factory(AttributeValue::class)->create([
            'value' => '1 prijímač',
            'attribute_id' => $colorAttr->id
        ]);

        factory(AttributeValue::class)->create([
            'value' => '2 prijímače',
            'attribute_id' => $colorAttr->id
        ]);

        factory(AttributeValue::class)->create([
            'value' => '3 prijímače',
            'attribute_id' => $colorAttr->id
        ]);

        factory(AttributeValue::class)->create([
            'value' => '4 prijímače',
            'attribute_id' => $colorAttr->id
        ]);
    }
}