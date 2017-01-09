<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@local',
            'password' => bcrypt('123456'),
            'role' => 'admin'
        ]);

        DB::table('currency')->insert([
            'name' => 'RUB',
            'coefficient' => 63.87,
            'prefix' => 'руб.',
        ]);

        DB::table('currency')->insert([
            'name' => 'UAH',
            'coefficient' => 26.1,
            'prefix' => 'грн.',
        ]);

        DB::table('currency')->insert([
            'name' => 'USD',
            'coefficient' => 1,
            'prefix' => '$',
        ]);

        DB::table('language')->insert([
            'name' => 'Russian',
            'code' => 'ru',
            'status' => 1,
            'image' => 'smarty/images/flags/ru.png',
        ]);

        DB::table('language')->insert([
            'name' => 'English',
            'code' => 'en',
            'status' => 1,
            'image' => 'smarty/images/flags/en.png',
        ]);

        DB::table('language')->insert([
            'name' => 'Ukrainian',
            'code' => 'ua',
            'status' => 1,
            'image' => 'smarty/images/flags/ua.png',
        ]);

        DB::table('sliders')->insert([
            'name' => 'Главный',
            'description' => 'слайдер на главной странице',
            'identificator' => 'home_slider',
            'type' => 'slider',
            'data' => 'a:2:{i:0;a:2:{s:5:"image";s:44:"G4EEDzYhf1jJodbth2HnlIf0annzbPt3pguuPvmp.jpg";s:4:"link";s:29:"http://localhost:8000/catalog";}i:1;a:2:{s:5:"image";s:44:"cvQsN6yTeZlg2SsTfbZnJfAlGhGNlzLvNNnGG8tn.jpg";s:4:"link";s:29:"http://localhost:8000/catalog";}}',
        ]);

//        DB::table('info')->insert([
//            'text' => 'content'
//        ]);


    }

}
