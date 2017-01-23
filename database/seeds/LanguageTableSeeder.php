<?php

use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
