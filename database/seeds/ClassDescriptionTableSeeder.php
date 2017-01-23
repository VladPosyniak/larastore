<?php

use Illuminate\Database\Seeder;

class ClassDescriptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('class_description')->insert([
            'class_id' => 1,
            'language_id' => 1,
            'name' => 'Цветы',
            'title' => 'Цветы',
            'description' => 'Лидер доставки цветов по Украине. Купить цветы: быстро и надежно!
Работаем круглосуточно · Скидки на цветы до -25% · Оплата картой или курьеру при получении.',
            'keywords' => 'цветы, букет, роза, розы, тюльпаны, 8 марта',
        ]);

        DB::table('class_description')->insert([
            'class_id' => 1,
            'language_id' => 2,
            'name' => 'Flowers',
            'title' => 'Flowers',
            'description' => 'Flowers delivery leader in Ukraine. Buy flowers: quickly and reliably!
We work around the clock · Discounts on the flowers to -25% · Payment card or courier upon receipt.',
            'keywords' => 'flowers, bouquet, rose, roses, tulips, 8 March',
        ]);

        DB::table('class_description')->insert([
            'class_id' => 1,
            'language_id' => 3,
            'name' => 'Квіти',
            'title' => 'Квіти',
            'description' => 'Лідер доставки квітів по Україні. Купити квіти: швидко і надійно!
Працюємо цілодобово · Знижки на квіти до -25% · Оплата картою або кур\'єру при отриманні.',
            'keywords' => 'квіти, букет, троянда, троянди, тюльпани, 8 березня',
        ]);
    }
}
