<?php

use Illuminate\Database\Seeder;

class SlidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sliders')->insert([
            'name' => 'Главный',
            'description' => 'слайдер на главной странице',
            'identificator' => 'home_slider',
            'type' => 'slider',
            'data' => 'a:2:{i:0;a:2:{s:5:"image";s:44:"G4EEDzYhf1jJodbth2HnlIf0annzbPt3pguuPvmp.jpg";s:4:"link";s:29:"http://localhost:8000/catalog";}i:1;a:2:{s:5:"image";s:44:"cvQsN6yTeZlg2SsTfbZnJfAlGhGNlzLvNNnGG8tn.jpg";s:4:"link";s:29:"http://localhost:8000/catalog";}}',
        ]);
        DB::table('sliders')->insert([
            'name' => 'Баннер в левой колонке ',
            'description' => 'Баннер в левой колонке в каталоге',
            'identificator' => 'left_column_banner',
            'type' => 'banner',
            'data' => 'a:2:{i:0;a:2:{s:5:"image";s:44:"dnxtzpChdq0ZsBRCrYkdVqMoF8XLO1fudK6ZQ7Kp.png";s:4:"link";s:29:"http://localhost:8000/catalog";}i:1;a:2:{s:5:"image";s:44:"3GsixDPNnmkDqsdepvqqQftwmPXYQSjhwjXA6fi6.png";s:4:"link";s:29:"http://localhost:8000/catalog";}}',
        ]);
    }
}
