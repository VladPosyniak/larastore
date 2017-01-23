<?php

use Illuminate\Database\Seeder;

class FilterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('filter')->insert(
            [
                'filter_group_id' => 1
            ]
        );
        DB::table('filter')->insert(
            [
                'filter_group_id' => 1
            ]
        );
    }
}
