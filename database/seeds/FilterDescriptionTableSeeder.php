<?php

use Illuminate\Database\Seeder;

class FilterDescriptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('filter_description')->insert(
            [
                'filter_id' => 1,
                'language_id' => 1,
                'value' => '20 сантиметров',
            ]
        );
        DB::table('filter_description')->insert(
            [
                'filter_id' => 1,
                'language_id' => 2,
                'value' => '20 centimeters',
            ]
        );
        DB::table('filter_description')->insert(
            [
                'filter_id' => 1,
                'language_id' => 3,
                'value' => '20 сантиметрів',
            ]
        );


        DB::table('filter_description')->insert(
            [
                'filter_id' => 2,
                'language_id' => 1,
                'value' => '30 сантиметров',
            ]
        );
        DB::table('filter_description')->insert(
            [
                'filter_id' => 2,
                'language_id' => 2,
                'value' => '30 centimeters',
            ]
        );
        DB::table('filter_description')->insert(
            [
                'filter_id' => 2,
                'language_id' => 3,
                'value' => '30 сантиметрів',
            ]
        );
    }
}
