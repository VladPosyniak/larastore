<?php

use Illuminate\Database\Seeder;

class ParametersDescriptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parameters_description')->insert(
            [
                'language_id' => 1,
                'parameter_id' => 1,
                'title' => 'Цвет',
                'unit' => '',
            ]
        );
        DB::table('parameters_description')->insert(
            [
                'language_id' => 2,
                'parameter_id' => 1,
                'title' => 'Colour',
                'unit' => '',
            ]
        );
        DB::table('parameters_description')->insert(
            [
                'language_id' => 3,
                'parameter_id' => 1,
                'title' => 'Колір',
                'unit' => '',
            ]
        );


        DB::table('parameters_description')->insert(
            [
                'language_id' => 1,
                'parameter_id' => 2,
                'title' => 'Количество',
                'unit' => 'штук',
            ]
        );
        DB::table('parameters_description')->insert(
            [
                'language_id' => 2,
                'parameter_id' => 2,
                'title' => 'Quantity ',
                'unit' => 'pcs',
            ]
        );
        DB::table('parameters_description')->insert(
            [
                'language_id' => 3,
                'parameter_id' => 2,
                'title' => 'Кількість',
                'unit' => 'штук',
            ]
        );
    }
}
