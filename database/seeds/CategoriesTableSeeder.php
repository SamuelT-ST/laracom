<?php

use App\Shop\Categories\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     *
     */
    public function run()
    {
        Category::rebuildTree($this->getCategories(), true);
    }

    private function getCategories()
    {
        return [
            [
                'name' => 'LED svietidlá',
                'children' =>
                    [
                        [
                            'name' => 'Interiérové',
                            'children' =>
                                [
                                    [
                                        'name' => 'Bodové',
                                    ],
                                    [
                                        'name' => 'Zapustené',
                                    ],
                                    [
                                        'name' => 'Stropné',
                                    ],
                                    [
                                        'name' => 'Závesné',
                                    ],
                                    [
                                        'name' => 'Bočné, nástenné',
                                    ],
                                    [
                                        'name' => 'Kúpeľňové',
                                    ],
                                    [
                                        'name' => 'Stojanové',
                                    ],
                                    [
                                        'name' => 'Stolové',
                                    ],
                                ],
                        ],
                        [
                            'name' => 'Exteriérové',
                            'children' =>
                                [
                                    [
                                        'name' => 'Stropné, závesné',
                                    ],
                                    [
                                        'name' => 'Bočné, nástenné',
                                    ],
                                    [
                                        'name' => 'Stojanové',
                                    ],
                                ],
                        ],
                        [
                            'name' => 'Kancelárske a priemyselné',
                            'children' =>
                                [
                                    [
                                        'name' => 'Koľajnicové svietidlá',
                                    ],
                                    [
                                        'name' => 'LED panely',
                                    ],
                                    [
                                        'name' => 'LED reflektory',
                                    ],
                                    [
                                        'name' => 'Priemyselné LED svietidlá',
                                    ],
                                ],
                        ],
                    ],

            ],
            [
                'name' => 'LED pásy, zdroje, profily',
                'children' =>
                    [
                        [
                            'name' => 'Hotové sady na mieru',
                        ],
                        [
                            'name' => 'LED pásy',
                            'children' =>
                                [
                                    [
                                        'name' => 'Biele',
                                    ],
                                    [
                                        'name' => 'Teplá-studená farba (CCT)',
                                    ],
                                    [
                                        'name' => 'Viacfarebné (RGB, RGBW)',
                                    ],
                                    [
                                        'name' => 'Farebné',
                                    ],
                                    [
                                        'name' => 'Spojky a konektory',
                                    ],
                                ]
                        ],
                        [
                            'name' => 'LED ovládače',
                            'children' =>
                                [
                                    [
                                        'name' => 'Jednofarebné ovládače',
                                    ],
                                    [
                                        'name' => 'RGB ovládače',
                                    ],
                                    [
                                        'name' => 'Ovládače do profilov',
                                    ],
                                    [
                                        'name' => 'Hudobné ovládače',
                                    ],
                                    [
                                        'name' => 'Zosilňovače',
                                    ],
                                ]
                        ],
                        [
                            'name' => 'Napájacie zdroje',
                            'children' =>
                                [
                                    [
                                        'name' => 'Interiérové plastové',
                                    ],
                                    [
                                        'name' => 'Interiérové profi',
                                    ],
                                    [
                                        'name' => 'Vodeodolné profi',
                                    ],
                                    [
                                        'name' => 'Na DIN lištu',
                                    ],
                                    [
                                        'name' => 'Stmievateľné a špeciálne',
                                    ],
                                ]
                        ],
                        [
                            'name' => 'Hliníkové profily',
                            'children' =>
                                [
                                    [
                                        'name' => 'Hliníkové profily',
                                    ],
                                    [
                                        'name' => 'Difúzory',
                                    ],
                                    [
                                        'name' => 'Záslepky',
                                    ],
                                    [
                                        'name' => 'Úchyty',
                                    ],
                                ]
                        ],
                    ]
            ],
            [
                'name' => 'LED žiarovky',
                'children' =>
                    [
                        [
                            'name' => 'LED trubice',
                        ],
                        [
                            'name' => 'E27 (hrubý závit)',
                            'children' =>
                                [
                                    [
                                        'name' => 'Nestmievateľné',
                                    ],
                                    [
                                        'name' => 'Stmievateľné',
                                    ],
                                    [
                                        'name' => 'RGB a farebné',
                                    ],
                                ],
                        ],
                        [
                            'name' => 'E14 (tenký závit)',
                            'children' =>
                                [
                                    [
                                        'name' => 'Nestmievateľné',
                                    ],
                                    [
                                        'name' => 'Stmievateľné',
                                    ],
                                ],
                        ],
                        [
                            'name' => 'GU10 (bodovka)',
                            'children' =>
                                [
                                    [
                                        'name' => 'Nestmievateľné',
                                    ],
                                    [
                                        'name' => 'Stmievateľné',
                                    ],
                                    [
                                        'name' => 'RGB a farebné',
                                    ],
                                ],
                        ],
                        [
                            'name' => 'GU5,3 (bodovka)',
                            'children' =>
                                [
                                    [
                                        'name' => 'Nestmievateľné',
                                    ],
                                    [
                                        'name' => 'Stmievateľné',
                                    ],
                                ],
                        ],
                        [
                            'name' => 'Ostatné žiarovky',
                        ],
                    ],
            ],
            [
                'name' => 'Elektromateriál',
                'children' =>
                    [
                        [
                            'name' => 'Káblové spojky',
                        ],
                        [
                            'name' => 'Káble a koncovky',
                        ],
                        [
                            'name' => 'Upevnenie profilov',
                            'children' =>
                                [
                                    [
                                        'name' => 'Montážne lepidlá',
                                    ],
                                    [
                                        'name' => 'Obojstranné pásky',
                                    ],
                                ],
                        ],
                        [
                            'name' => 'Cín na spájkovanie',
                        ],
                    ],
            ],
        ];
    }
}