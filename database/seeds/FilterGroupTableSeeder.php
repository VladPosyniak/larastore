<?php

use Illuminate\Database\Seeder;

class FilterGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('filter_group')->insert(
            [
                'filter_class_id' => 1
            ]
        );
    }
}
