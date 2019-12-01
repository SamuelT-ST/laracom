<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FillCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $this->getCategories()->each(function ($category, $index) {
                $this->insertCategory($category);
            });
        });
    }

    /**
     * @param $category
     * @param null $parentCategoryId
     */
    private function insertCategory($category, $parentCategoryId = null)
    {
        $parentCategoryIdText = $parentCategoryId ? $parentCategoryId.'-' : '';

        $parentId = DB::table('categories')->insertGetId([
            'name' => '{"sk":"'.$category['title'].'"}',
            'parent_id' => $parentCategoryId,
            'slug' => $parentCategoryIdText . str_slug($category['title'])
        ]);

        $this->traverseSubcategories($category, $parentId);
    }

    /**
     * @param $parent
     * @param $parentCategoryId
     */
    private function traverseSubcategories($parent, $parentCategoryId)
    {
        if (array_key_exists('subcategories', $parent)) {
            collect($parent['subcategories'])->each(function ($category) use ($parentCategoryId) {
                $this->insertCategory($category, $parentCategoryId);
            });
        }
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function getCategories()
    {
        return collect([
            [
                'title' => 'LED svietidlá',
                'subcategories' =>
                    [
                        [
                            'title' => 'Interiérové',
                            'subcategories' =>
                                [
                                    [
                                        'title' => 'Bodové',
                                    ],
                                    [
                                        'title' => 'Zapustené',
                                    ],
                                    [
                                        'title' => 'Stropné',
                                    ],
                                    [
                                        'title' => 'Závesné',
                                    ],
                                    [
                                        'title' => 'Bočné, nástenné',
                                    ],
                                    [
                                        'title' => 'Kúpeľňové',
                                    ],
                                    [
                                        'title' => 'Stojanové',
                                    ],
                                    [
                                        'title' => 'Stolové',
                                    ],
                                ],
                        ],
                        [
                            'title' => 'Exteriérové',
                            'subcategories' =>
                                [
                                    [
                                        'title' => 'Stropné, závesné',
                                    ],
                                    [
                                        'title' => 'Bočné, nástenné',
                                    ],
                                    [
                                        'title' => 'Stojanové',
                                    ],
                                ],
                        ],
                        [
                            'title' => 'Kancelárske a priemyselné',
                            'subcategories' =>
                                [
                                    [
                                        'title' => 'Koľajnicové svietidlá',
                                    ],
                                    [
                                        'title' => 'LED panely',
                                    ],
                                    [
                                        'title' => 'LED reflektory',
                                    ],
                                    [
                                        'title' => 'Priemyselné LED svietidlá',
                                    ],
                                ],
                        ],
                    ],

            ],
            [
                'title' => 'LED pásy, zdroje, profily',
                'subcategories' =>
                    [
                        [
                            'title' => 'Hotové sady na mieru',
                        ],
                        [
                            'title' => 'LED pásy',
                            'subcategories' =>
                                [
                                    [
                                        'title' => 'Biele',
                                    ],
                                    [
                                        'title' => 'Teplá-studená farba (CCT)',
                                    ],
                                    [
                                        'title' => 'Viacfarebné (RGB, RGBW)',
                                    ],
                                    [
                                        'title' => 'Farebné',
                                    ],
                                    [
                                        'title' => 'Spojky a konektory',
                                    ],
                                ]
                        ],
                        [
                            'title' => 'LED ovládače',
                            'subcategories' =>
                                [
                                    [
                                        'title' => 'Jednofarebné ovládače',
                                    ],
                                    [
                                        'title' => 'RGB ovládače',
                                    ],
                                    [
                                        'title' => 'Ovládače do profilov',
                                    ],
                                    [
                                        'title' => 'Hudobné ovládače',
                                    ],
                                    [
                                        'title' => 'Zosilňovače',
                                    ],
                                ]
                        ],
                        [
                            'title' => 'Napájacie zdroje',
                            'subcategories' =>
                                [
                                    [
                                        'title' => 'Interiérové plastové',
                                    ],
                                    [
                                        'title' => 'Interiérové profi',
                                    ],
                                    [
                                        'title' => 'Vodeodolné profi',
                                    ],
                                    [
                                        'title' => 'Na DIN lištu',
                                    ],
                                    [
                                        'title' => 'Stmievateľné a špeciálne',
                                    ],
                                ]
                        ],
                        [
                            'title' => 'Hliníkové profily',
                            'subcategories' =>
                                [
                                    [
                                        'title' => 'Hliníkové profily',
                                    ],
                                    [
                                        'title' => 'Difúzory',
                                    ],
                                    [
                                        'title' => 'Záslepky',
                                    ],
                                    [
                                        'title' => 'Úchyty',
                                    ],
                                ]
                        ],
                    ]
            ],
            [
                'title' => 'LED žiarovky',
                'subcategories' =>
                    [
                        [
                            'title' => 'LED trubice',
                        ],
                        [
                            'title' => 'E27 (hrubý závit)',
                            'subcategories' =>
                                [
                                    [
                                        'title' => 'Nestmievateľné',
                                    ],
                                    [
                                        'title' => 'Stmievateľné',
                                    ],
                                    [
                                        'title' => 'RGB a farebné',
                                    ],
                                ],
                        ],
                        [
                            'title' => 'E14 (tenký závit)',
                            'subcategories' =>
                                [
                                    [
                                        'title' => 'Nestmievateľné',
                                    ],
                                    [
                                        'title' => 'Stmievateľné',
                                    ],
                                ],
                        ],
                        [
                            'title' => 'GU10 (bodovka)',
                            'subcategories' =>
                                [
                                    [
                                        'title' => 'Nestmievateľné',
                                    ],
                                    [
                                        'title' => 'Stmievateľné',
                                    ],
                                    [
                                        'title' => 'RGB a farebné',
                                    ],
                                ],
                        ],
                        [
                            'title' => 'GU5,3 (bodovka)',
                            'subcategories' =>
                                [
                                    [
                                        'title' => 'Nestmievateľné',
                                    ],
                                    [
                                        'title' => 'Stmievateľné',
                                    ],
                                ],
                        ],
                        [
                            'title' => 'Ostatné žiarovky',
                        ],
                    ],
            ],
            [
                'title' => 'Elektromateriál',
                'subcategories' =>
                    [
                        [
                            'title' => 'Káblové spojky',
                        ],
                        [
                            'title' => 'Káble a koncovky',
                        ],
                        [
                            'title' => 'Upevnenie profilov',
                            'subcategories' =>
                                [
                                    [
                                        'title' => 'Montážne lepidlá',
                                    ],
                                    [
                                        'title' => 'Obojstranné pásky',
                                    ],
                                ],
                        ],
                        [
                            'title' => 'Cín na spájkovanie',
                        ],
                    ],
            ],
        ]);
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            DB::table('categories')->truncate();
        });
    }
}
