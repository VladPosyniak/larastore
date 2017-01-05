<?php

use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Тюльпаны',
                "cover" => 'St0H8F2zdANzC9VBotaNHhbNLGS3CvADqx0WgSu6.jpg',
                'urlhash' => 'tulips',
                'class_id' => 1
            ],
            [
                'name' => 'Розы',
                "cover" => 'RF6kWNWtVrsB3A7o8SbYr2d3b6uzAjPbtCFr097Y.jpg',
                'urlhash' => 'roses',
                'class_id' => 1
            ],
            [
                'name' => 'smartwatch',
                "cover" => 'SWqUjedyMWk33Fe6hr6JBagxgZt3NNi53pWXie9z.png',
                'urlhash' => 'smartwatch',
                'class_id' => 2
            ]

        ]);

        DB::table('classes')->insert([
            [
                'name' => 'flowers',
                "cover" => 'http://mint.net.ua/wp-content/uploads/2015/08/5.jpg',
                'urlhash' => 'flowers',
            ],
            [
                'name' => 'watches',
                "cover" => 'https://api.sonymobile.com/files/SmartWatch-3-SWR50-yellow-1240x840-1cb6708bbef6de1cac74f50514a53c25-1cb6708bbef6de1cac74f50514a53c25.jpg',
                'urlhash' => 'watches',
            ]

        ]);

        DB::table('parameters')->insert([
            [
                'title' => 'Вес',
                'unit' => 'кг'
            ],
            [
                'title' => 'Длина',
                'unit' => 'см'
            ]

        ]);

        DB::table('parameters')->insert([
            [
                'items_id' => 2,
                'parameters_id' => 1,
                'value' => '0.2',

            ],
            [
                'items_id' => 1,
                'parameters_id' => 2,
                'value' => 30,

            ],
            [
                'items_id' => 4,
                'parameters_id' => 2,
                'value' => 40,

            ],
            [
                'items_id' => 4,
                'parameters_id' => 1,
                'value' => 0.1,

            ],

        ]);

        DB::table('products')->insert([
            [
                'name' => 'Тюльпаны в декоративной вазе',
                'description' => 'Тюльпа́н — род многолетних травянистых луковичных растений семейства Лилейные, в современных систематиках включающий более 80 видов. Центр происхождения и наибольшего разнообразия видов тюльпанов — горы северного Ирана, Памиро-Алай и Тянь-Шань.',
                'description_full' => 'Тюльпан (лат. Tulipa) – род луковичных многолетников семейства Лилейные, одно из самых популярных весенних садовых растений, выращиваемых как в частных садах, так и в промышленных масштабах. Родина тюльпанов – Средняя Азия, а название растение получило от персидского слова «тюрбан», форму которого напоминает цветок. Впервые ввели тюльпан в культуру в Персии, там он был воспет многими поэтами, в том числе и самим Хафизом, но настоящее поклонение и любовь вызвали тюльпаны в Турции: их во множестве разводили в сералях жены султана, соревнуясь в доказательствах своей к нему любви. В европейском Аугсбурге тюльпаны появились в 1554 году и мало-помалу стали завоевывать сердца искушенных европейцев, привыкших к разным диковинам. И среди титулованных особ Европы появились страстные и неутомимые коллекционеры сортов тюльпана, готовые уплатить за новую разновидность сумасшедшие деньги – например, граф Паппенгейм, кардинал Ришелье, Вольтер, император Франц ІІ и Луи XVIII, который любил устраивать в Версале «тюльпанные праздники».',
                'values'=>'Тюльпаны в декоративной вазе',
                'cover' => 'X4IEQQuGSc4i6rAebVzY7TDFxxqLdhMfIjQmdeKG.jpg',
                'price'=>400,
                'price_old'=>'450',
                'isset'=>true,
                'visible'=>true,
                'urlhash'=>'tulpani_v_decorativnoy_vase',
                'categories_id'=>1,
                'class_id'=>1
            ],
            [
                'name' => 'Смарт Часы - Apro Q18 ( 8 ГБ )',
                'description' => 'Смарт Часы - Apro Q18 ( 8 ГБ )',
                'description_full' => 'Смарт Часы - Apro Q18 ( 8 ГБ )',
                'values'=>'',
                'cover' => 'eg0t0QNLzi7RSzyHmTHure3FnaQBa7pZCHnrsnWi.png',
                'price'=>999,
                'price_old'=>'1499',
                'isset'=>true,
                'visible'=>true,
                'urlhash'=>'apro-Q18 ',
                'categories_id'=>3,
                'class_id'=>2
            ],
            [
                'name' => 'Красные тюльпаны по-штучно',
                'description' => 'Красные тюльпаны по-штучно',
                'description_full' => 'Красные тюльпаны по-штучно',
                'values'=>'Красные тюльпаны по-штучно',
                'cover' => 'oygnwWW8wfhbXJEErxinjrisuLbO0YGBcbUFnMT3.jpg',
                'price'=>15,
                'price_old'=>'',
                'isset'=>true,
                'visible'=>true,
                'urlhash'=>'krasnie-tulpani-postuchno',
                'categories_id'=>1,
                'class_id'=>1
            ],
            [
                'name' => 'Красная роза по-штучно',
                'description' => 'Красная роза по-штучно',
                'description_full' => 'Красная роза по-штучно',
                'values'=>'Красная роза по-штучно',
                'cover' => 'u4VtFA9kduV0znQAveGVkhFCDiNmpkLkHx7VC6lp.jpg',
                'price'=>30,
                'price_old'=>'',
                'isset'=>true,
                'visible'=>true,
                'urlhash'=>'krasnaya-rosa-postuchno',
                'categories_id'=>2,
                'class_id'=>1
            ],
            [
                'name' => 'Букет розовых роз',
                'description' => 'Букет розовых роз',
                'description_full' => 'Букет розовых роз',
                'values'=>'Букет розовых роз',
                'cover' => 'sj5sq4LM7SGQMGWgnpSuvoHUIxwaQghVuB51XyoB.jpg',
                'price'=>500,
                'price_old'=>'',
                'isset'=>true,
                'visible'=>true,
                'urlhash'=>'buket_rosovih_ros',
                'categories_id'=>2,
                'class_id'=>1
            ],

        ]);

        DB::table('filter_group')->insert([
            [
                'filter_class_id'=> 1,
                'name' => 'Тип букета'
            ],
            [
                'filter_class_id'=> 1,
                'name' => 'Длина стебеля'
            ],
            [
                'filter_class_id'=> 2,
                'name' => 'Материал коропуса'
            ],
            [
                'filter_class_id'=> 2,
                'name' => 'Диагональ дисплея'
            ],

        ]);
        DB::table('product_filter')->insert([

            [
                'product_id'=> 3,
                'filter_id' => 1
            ],
            [
                'product_id'=> 4,
                'filter_id' => 1
            ],
            [
                'product_id'=> 1,
                'filter_id' => 2
            ],
            [
                'product_id'=> 5,
                'filter_id' => 2
            ],
            [
                'product_id'=> 1,
                'filter_id' => 4
            ],
            [
                'product_id'=> 4,
                'filter_id' => 4
            ],
            [
                'product_id'=> 3,
                'filter_id' => 4
            ],
            [
                'product_id'=> 5,
                'filter_id' => 4
            ],

        ]);

        DB::table('filter')->insert([
            [
                'filter_group_id' => 1,
                'value' => 'по-штучно'
            ],
            [
                'filter_group_id' => 1,
                'value' => 'букет'
            ],
            [
                'filter_group_id' => 2,
                'value' => 'короткий'
            ],
            [
                'filter_group_id' => 2,
                'value' => 'длинний'
            ],
            [
                'filter_group_id' => 3,
                'value' => 'пластик'
            ],
            [
                'filter_group_id' => 3,
                'value' => 'металл'
            ],
            [
                'filter_group_id' => 3,
                'value' => 'алюминний'
            ],
            [
                'filter_group_id' => 4,
                'value' => '1.5 дюйма'
            ],
            [
                'filter_group_id' => 4,
                'value' => '2 дюйма'
            ]

        ]);
    }
}
