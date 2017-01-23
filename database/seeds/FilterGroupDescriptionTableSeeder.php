<?php

use Illuminate\Database\Seeder;

class FilterGroupDescriptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('filter_group_description')->insert(
            [
                'name' => 'Длина стебеля',
                'filter_group_id' => 1,
                'language_id' => 1
            ]
        );
        DB::table('filter_group_description')->insert(
            [
                'name' => 'Stebel length',
                'filter_group_id' => 1,
                'language_id' => 2
            ]
        );
        DB::table('filter_group_description')->insert(
            [
                'name' => 'Довжина ножки',
                'filter_group_id' => 1,
                'language_id' => 3
            ]
        );
    }
}
