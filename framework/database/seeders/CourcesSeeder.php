<?php

namespace Database\Seeders;

use App\Models\Cource;
use App\Models\Image;
use App\Models\ImageList;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class CourcesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $images = [
            new Image([
                'path' => 'img/ico_ОХРАНА ТРУДА.png',
                'mime' => 'image/png',
            ]),
            new Image([
                'path' => 'img/ico_ПТМ.png',
                'mime' => 'image/png',
            ]),
            new Image([
                'path' => 'img/ico_ПТЭЭП.png',
                'mime' => 'image/png',
            ]),
            new Image([
                'path' => 'img/ico_ДОПОГ.png',
                'mime' => 'image/png',
            ]),
        ];
        $image_lists = [
            new ImageList([
                'title' => 'Охрана Труда',
                'slug' => 'ОТ',
            ]),
            new ImageList([
                'title' => 'Пожарно-технический минимум',
                'slug' => 'ПТМ',
            ]),
            new ImageList([
                'title' => 'Обучение по электробезопасносности, ПТЭЭП',
                'slug' => 'ПТЭЭП',
            ]),
            new ImageList([
                'title' => 'Перевозка различных видов опасных грузов',
                'slug' => 'ДОПОГ',
            ]),
        ];
        foreach ($images as $image) {
            $image->save();
        }

        foreach ($image_lists as $key => $il) {
            $il->save();
            $il->images()->attach($images[$key], ['tag' => 'icon']);
        }
        $root = [
            [
                'id' => 1,
                'title' => 'root',
                'isLeaf' => false,
                'children' => [
                    [
                        'id' => 2,
                        'title' => 'Повышение квалификации руководителей и специалистов',
                        'isLeaf' => false,
                        'children' => [
                            [
                                'id' => 3,
                                'title' => 'Охрана Труда',
                                'slug' => 'ОТ',
                                'header' => 'ОТ',
                                'description' => 'Обучениепо охране труда для руководителей и специалистов',
                            ],
                            [
                                'id' => 4,
                                'title' => 'Обучение по пожарно-техническому минимуму',
                                'slug' => 'ПТМ',
                                'description' => 'Обучение по пожарно-техническому минимуму'],
                        ],
                    ],
                    [
                        'id' => 5,
                        'title' => 'Профессиональная подготовка рабочих',
                        'isLeaf' => false,
                        'children' => [
                            [
                                'id' => 6,
                                'title' => 'Обучение по электробезопасносности, ПТЭЭП',
                                'slug' => 'ПТЭЭП',
                                'description' => 'Обучение по электробезопасносности, ПТЭЭП',
                            ],
                        ],
                    ],
                    [
                        'id' => 7,
                        'title' => 'Обучение БДД ДОПОГ',
                        'isLeaf' => false,
                        'children' => [
                            [
                                'id' => 8,
                                'title' => 'Обучение водителей перевозке различных видов опасных грузов',
                                'slug' => 'ДОПОГ',
                                'description' => 'Обучение водителей перевозке различных видов опасных грузов',
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $cources_images_lists = [
            3 => 0,
            4 => 1,
            6 => 2,
            8 => 3,
        ];

        $this->createFromArray($root, null, $image_lists, $cources_images_lists);

    }
    private function createFromArray(array $structure, int $parent_id = null, array &$image_lists = null, array &$cources_images_lists = null)
    {

        foreach ($structure as $item) {

            if ($parent_id === null) {
                $cource = new Cource(Arr::except($item, ['children']));

            } else {
                $cource = new Cource(array_merge(Arr::except($item, ['children']), ['parent_id' => $parent_id]));
            }
            $cource->save();
            if (array_key_exists($cource->id, $cources_images_lists)) {                
                $cource->image_list()->save($image_lists[$cources_images_lists[$cource->id]]);
            }
            if (array_key_exists('children', $item)) {
                $this->createFromArray($item['children'], $cource->id, $image_lists, $cources_images_lists);
            }
        }
    }
}
